<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Role::user_role(Auth::id()) != 'partner'){
          return view('admin.company.index', [
            'companyes' => Company::paginate(10)
          ]);
        } else return view('partners.company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if(Role::user_role(Auth::id()) != 'partner'){
        return view('admin.company.create', [
          'users' => User::all(),
          'user_mail' => false
        ]);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = $this->validate($request, [
          'name' => 'required|string|max:255',
          'hashtag' => 'required|string|max:30|unique:companies',
          'fullname' => 'required|string|max:255',
          'address' => 'required|string|max:255',
          'ur_address' => 'required|string|max:255',
          'phone' => 'required|string|max:255',
          'email' => 'required|string|email|max:30',
          'site' => 'string|max:100',
          'caption' => 'nullable|string',
      ]);

      $company_id = Company::staticSave([
        'hashtag' => $request['hashtag'],
        'name' => $request['name'],
        'fullname' => $request['fullname'],
        'address' => $request['address'],
        'ur_address' => $request['ur_address'],
        'phone' => $request['phone'],
        'email' => $request['email'],
        'site' => $request['site'],
        'caption' => $request['caption'],
        'created_at' => date('Y-m-d H:i:s')
      ]);

      Company::company_user_save($company_id, $request['users_mail']);

      return redirect()->route('admin.company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $company = Company::getCompany(User::companyId(Auth::id()));
        $profile = User::getUser(Auth::id());

        return view('partners.company.index', [
          'company' => $company,
          'profile' => $profile,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
      if(Role::user_role(Auth::id()) != 'partner'){
        return view('admin.company.edit', [
          'company' => $company,
          'users' => User::all(),
          'user_mail' => $company->userMail($company->id)
        ]);
      } else {
        return view('partners.company.edit', [
          'company' => $company,
          'user_mail' => $company->userMail($company->id)
        ]);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
      $validator = $this->validate($request, [
          'name' => 'required|string|max:255',
          'hashtag' => 'required|string|max:30',
          'fullname' => 'required|string|max:255',
          'address' => 'required|string|max:255',
          'ur_address' => 'required|string|max:255',
          'phone' => 'required|string|max:255',
          'email' => 'required|string|email|max:30',
          'site' => 'nullable|string|max:100',
          'caption' => 'nullable|string',
      ]);

      $company->name = $request['name'];
      $company->hashtag = $request['hashtag'];
      $company->fullname = $request['fullname'];
      $company->address = $request['address'];
      $company->ur_address = $request['ur_address'];
      $company->phone = $request['phone'];
      $company->email = $request['email'];
      $company->site = $request['site'];
      $company->caption = $request['caption'];
      $company->save();

      Company::company_user_update($company->id, $request['users_mail']);

      if(Role::user_role(Auth::id()) != 'partner'){
        return redirect()->route('admin.company.index');
      } else return redirect()->route('partners.company.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
      Company::company_user_delete($company->id);
      $company->delete();

      return redirect()->route('admin.company.index');
    }
}
