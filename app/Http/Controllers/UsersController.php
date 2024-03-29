<?php

namespace App\Http\Controllers;

use App\Director;
use App\Profile;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;

class UsersController extends Controller
{

//    Important properties
    public $parentModel = User::class;
    public $parentRoute = 'user';
    public $parentView = "admin.user";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = $this->parentModel::orderBy('created_at', 'desc')->paginate(60);
        return view($this->parentView . '.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->parentView . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1|confirmed',
            'role_manage_id' => 'required|min:1',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_manage_id' => $request->role_manage_id,
        ]);

        //For director send data to manage directors table
        if ($request->role_manage_id == 2) {
            $director = new Director();
            $director->user_id = $user->id;
            $director->name = $request->name;
            $director->email = $request->email;
            $director->save();

        }

        Profile::create([
            'user_id' => $user->id,
        ]);

        Session::flash('success', "Successfully  Create");
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $item = $this->parentModel::withTrashed()->find($request->id);
        if (empty($item)) {
            Session::flash('error', "Item not found");
            return redirect()->route('role-manage');
        }
        $content = json_decode($item['content']);
        $item['content'] = $content;
        return view($this->parentView . '.show')->with('items', $item);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = $this->parentModel::find($id);
        return view($this->parentView . '.edit')->with('item', $items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role_manage_id' => 'numeric|min:1',
        ]);

        $user = User::find($id);
        if ($request->password === $request->confirm_password and !empty($request->password)) {

            $user->password = bcrypt($request->password);

        } elseif ($request->password !== $request->confirm_password) {

            Session::flash('error', "Password and Confirm Password should same");
            return redirect()->back();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_manage_id = $request->role_manage_id;

        $user->save();
        Session::flash('success', "Update Successfully");
        return redirect()->route($this->parentRoute);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::id() == $id) {
            Session::flash('error', "You Can Not Delete Yourself!");
            return redirect()->back();
        }
        $user = User::find($id);
        $user->delete();

        if ($user->role_manage_id == 2) {
            Director::where('user_id', $user->id)->delete();
        }

        Session::flash('success', "Successfully Trashed");
        return redirect()->back();
    }

    public function trashed()
    {

        $items = $this->parentModel::onlyTrashed()->paginate(60);
        return view($this->parentView . '.trashed')->with("items", $items);
    }

    public function trashedShow()
    {

        $id = $_POST["id"];
        $trashedItem = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        return response()->json($trashedItem);
    }

    public function restore($id)
    {
        $project = $this->parentModel::onlyTrashed()->where('id', $id)->first();

        $project->restore();
        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }

    public function kill($id)
    {
        $project = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        $project->forceDelete();

//        For Profile
        $profile = Profile::all()->where('user_id', $id)->first();
        $profile->delete();

        Session::flash('success', 'Permanently Delete');
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    {

        $request->validate([
            'search' => 'min:1',
        ]);

        $search = $request["search"];
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->paginate(60);

        return view($this->parentView . '.index')
            ->with('items', $items);

    }

    public function trashedSearch(Request $request)
    {

        $request->validate([
            'search' => 'min:1',
        ]);

        $search = $request["search"];
        $items = $this->parentModel::where('name', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->paginate(60);

        return view($this->parentView . '.trashed')
            ->with('items', $items);

    }

//    Fixed Method for all
    public function activeAction(Request $request)
    {

        $request->validate([
            'items' => 'required',
        ]);

        if ($request->apply_comand_top == 3 || $request->apply_comand_bottom == 3) {
            foreach ($request->items["id"] as $id) {
                $this->destroy($id);
            }

            return redirect()->back();

        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }

    }

    public function trashedAction(Request $request)
    {

        $request->validate([
            'items' => 'required',
        ]);

        if ($request->apply_comand_top == 1 || $request->apply_comand_bottom == 1) {

            foreach ($request->items["id"] as $id) {
                $this->restore($id);
            }

        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {

            foreach ($request->items["id"] as $id) {

                $this->kill($id);
            }
            return redirect()->back();

        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }
        return redirect()->back();
    }

    //Manage Directors

    public function manage_directors()
    {

        $directors = DB::table('directors')->get();
        return view($this->parentView . '.manage_directors')->with('directors', $directors);
    }

    //Edit Director
    public function edit_director($id)
    {
        $director = DB::table('directors')->where('id', $id)->first();
        return view($this->parentView . '.edit_director')->with('item', $director);
    }

    //Update
    public function update_director(Request $request)
    {
        $director = Director::where('id', $request->id)->first();

        $director->name = $request->name;
        $director->email = $request->email;
        $director->share = $request->share;
        $director->agent_share = $request->agent_share;

        $affected_id = $director->save();

        if (!empty($affected_id)) {
            Session::flash('success', "Update Successfully");
            return redirect()->route($this->parentRoute . ".manage_directors");
        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }

    }

    //Sales Done by Directors
    public function director_sales($id)
    {
        $director = DB::table('directors')->where('id', $id)->first();
        $director_sales = DB::table('sells')
            ->where('sells.director_id', $id)
            ->get();

        return view($this->parentView . '.director_sales')
            ->with('director', $director)
            ->with('director_sales', $director_sales);
    }

    public function director_sales_pdf($id)
    {
        // dd($id);
        $director = DB::table('directors')->where('id', $id)->first();
        $director_sales = DB::table('sells')
            ->where('sells.director_id', $id)
            ->get();

        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');

        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Director Sales',
        );

        $pdf = PDF::loadView($this->parentView . '.director_sales_pdf', ['director_sales' => $director_sales, 'director' => $director, 'extra' => $extra])->setPaper('a4', 'landscape');
        //return $pdf->stream('invoice.pdf');
        return $pdf->stream($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');

    }
}
