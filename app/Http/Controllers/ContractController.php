<?php

namespace App\Http\Controllers;

use App\User;
use App\Contract;
use NumberFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $temp       = ''; 
        $contracts  = Contract::all();
        
        foreach($contracts as $contract){
            $users = $contract->users()->toSql();
            dd($users);
            $contract->closure_at = date('d/m/Y', strtotime($contract->closure_at));
            
            foreach($users as $user){          
                if(empty($temp)){
                    $contract->salesman_one = $user->name;
                    $contract->salesman_one_commission = $user->commission;
                    $temp = $user->name;
                }else{
                    $contract->salesman_two = $user->name;
                    $contract->salesman_two_commission = $user->commission;
                    $temp = '';
                }
            }
            $temp = '';
            
        }
        
        return view("site.listContracts",[
            'contracts' => $contracts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        return view('site.newContract',[
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        $contract = new Contract();
        $contract->name = $request->name;
        $contract->closure_at = $request->closure_at;    
        $value = str_replace('.','',$request->contract_value);
        $value = str_replace(',','.',$value);
        $contract->contract_value = $value;        
        $contract->save();
        if(isset($request->salesman_one) && !empty($request->salesman_one)){
            $contract->users()->attach($request->salesman_one);
        }
        if(isset($request->salesman_two) && !empty($request->salesman_two)){
            $contract->users()->attach($request->salesman_two);
        }
        //dd($contract);
        return redirect()->route('contract.index');
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Contracts  $contracts
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        $temp                   = '';
        $users                  = $contract->users()->get();        
        $contract->closure_at   = date('d/m/Y', strtotime($contract->closure_at));
        foreach($users as $user){                
            if(empty($temp)){
                $contract->salesman_one = $user->name;
                $contract->commission_one = $user->commission;
                $temp = $user->name;
            }else{
                $contract->salesman_two = $user->name;
                $contract->commission_two = $user->commission;
                $temp = '';
            }
        }
        $temp = '';       

        if(isset($contract->salesman_two) && !empty($contract->salesman_two) && ($contract->commission_one+$contract->commission_two)>10){
            $contract->commission_one = $contract->commission_one/2;
            $contract->commission_two = $contract->commission_two/2;            
        }

        if(isset($contract->salesman_one) && !empty($contract->salesman_one)){
            $contract->commission_one_value = ($contract->contract_value*$contract->commission_one)/100;
        }

        if(isset($contract->salesman_two) && !empty($contract->salesman_two)){
            $contract->commission_two_value = ($contract->contract_value*$contract->commission_two)/100;
            $contract->commission_value_sum = $contract->commission_one_value+$contract->commission_two_value;
        }else{
            $contract->commission_value_sum = $contract->commission_one_value;
        }
        
        return view("site.dataContract",[
            'contract' => $contract
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contracts  $contracts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        $temp               = '';
        $users              = User::get();
        $users_contract     = $contract->users()->get();
        
        foreach($users_contract as $user){                
            if(empty($temp)){
                $contract->salesman_one = $user->id;
                $temp = $user->name;
            }else{
                $contract->salesman_two = $user->id;
                $temp = '';
            }
        }
        
        return view("site.editContract",[
            'contract' => $contract,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts  $contracts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        $contract->name             = $request->name;
        $contract->closure_at       = $request->closure_at;    
        $value                      = str_replace('.','',$request->contract_value);
        $value                      = str_replace(',','.',$value);
        $contract->contract_value   = $value;
        $contract->save();
        if(isset($request->salesman_one) && !empty($request->salesman_one) && isset($request->salesman_two) && !empty($request->salesman_two)){
            $contract->users()->sync([$request->salesman_one, $request->salesman_two]);
        }else if(isset($request->salesman_two) && !empty($request->salesman_two) && (!isset($request->salesman_one) || empty($request->salesman_one))){
            $contract->users()->sync($request->salesman_two);
        }else if(isset($request->salesman_one) && !empty($request->salesman_one) && (!isset($request->salesman_two) || empty($request->salesman_two))){
            $contract->users()->sync($request->salesman_one);
        }
        return redirect()->route('contract.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contracts  $contracts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();
        $contract->users()->sync($contract);
        return redirect()->route('contract.index');
    }

    /**
     * Display report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts  $contracts
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {
        $temp               = ''; 
        $sum_contracts      = 0;
        $sum_commission     = 0; 
        $contracts          = new Contract();
        $users              = new User();

        $usersAll           = User::all();

        if(isset($request->filter_date) && empty($request->filter_salesman)){
            //COM FILTRO MES/ANO            
            $date_ano       = explode('/',$request->filter_date);
            $mes            = $date_ano[0];
            $ano            = $date_ano[1];
            $contracts      = Contract::whereYear('closure_at', '=', $ano)->whereMonth('closure_at', '=', $mes)->get();
        }else if(isset($request->filter_salesman) && empty($request->filter_date)){
            //COM FILTRO VENDEDOR
            $users = User::where('id', $request->filter_salesman)->get();
            foreach($users as $user){
                $contracts  = $user->contracts()->get();
            }  
        }else if(isset($request->filter_salesman) && !empty($request->filter_salesman) && isset($request->filter_date) && !empty($request->filter_date)){
            //COM FILTRO VENDEDOR
            $date_ano       = explode('/',$request->filter_date);
            $mes            = $date_ano[0];
            $ano            = $date_ano[1];
            $date_ano       = $ano.'-'.$mes.'%';
            $users          = User::where('id', $request->filter_salesman)->get();            
            foreach($users as $user){
                $contracts  = $user->contracts()->where('contracts.closure_at', 'LIKE', $date_ano)->get();
            }  
        }else{
            $contracts      = Contract::all();
        }

        //SEM FILTRAR
        foreach($contracts as $contract){
            
            if(isset($users) || empty($users)){
                $users = $contract->users()->get();
            }            
            $contract->closure_at = date('d/m/Y', strtotime($contract->closure_at));
            foreach($users as $user){
                if(empty($temp)){
                    $contract->salesman_one = $user->name;
                    $contract->salesman_one_commission = $user->commission;
                    $temp = $user->name;
                }else{
                    $contract->salesman_two = $user->name;
                    $contract->salesman_two_commission = $user->commission;
                    $temp = '';
                }
            }
            //VALOR DA COMISSÃO COM 2 VENDEDORES
            if(isset($contract->salesman_two) && !empty($contract->salesman_two) && ($contract->commission_one+$contract->commission_two)>10){
                $contract->salesman_one_commission = $contract->salesman_one_commission/2;
                $contract->salesman_two_commission = $contract->salesman_two_commission/2;            
            }

            //VALOR DA COMISSÃO COM 1 VENDEDOR
            if(isset($contract->salesman_one) && !empty($contract->salesman_one)){
                $contract->commission_one_value = ($contract->contract_value*$contract->salesman_one_commission)/100;
            }

            //SE TIVER VALOR DA COMISSÃO COM 2 VENDEDOR
            if(isset($contract->salesman_two) && !empty($contract->salesman_two)){
                $contract->commission_two_value = ($contract->contract_value*$contract->salesman_two_commission)/100;
                $contract->commission_value_sum = $contract->commission_one_value+$contract->commission_two_value;
            }else{
                $contract->commission_value_sum = $contract->commission_one_value;
            }

            $sum_contracts  = $sum_contracts + $contract->contract_value;
            $sum_commission = $sum_commission + $contract->commission_value_sum;

            $temp = '';
        }
        
        return view("site.home",[
            'contracts' => $contracts,
            'users' => $usersAll,
            'sum_contracts' => $sum_contracts,
            'sum_commission' => $sum_commission
        ]);
    }
    
}
