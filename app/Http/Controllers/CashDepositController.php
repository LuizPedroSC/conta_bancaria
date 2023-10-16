<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\DTO\CashDepositDTO;
use App\Http\Requests\CashDepositRequest;
use App\Services\BankAccountService;
use App\Services\CashDepositService;
use App\Services\ResponseService;

class CashDepositController extends Controller
{
    const SUCCESS_MESSAGE =  'Deposito realizado com sucesso';
    
    private $CashDepositService;

    public function __construct(){
        $this->BankAccountService = new BankAccountService();
        $this->CashDepositService = new CashDepositService();
        $this->ResponseService = new ResponseService();
    }

    public function deposit(CashDepositRequest $request){
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $cashDeposit = new CashDepositDTO($data);
            $this->CashDepositService->deposit($cashDeposit);
            DB::commit();
            return $this->ResponseService->successResponse(self::SUCCESS_MESSAGE);
        } catch (Exception $e) {
            Log::error([
                'function' => 'CashDepositController@deposit',
                'error' => $e->getMessage(), 
                'data' => $data
            ]);
            DB::rollBack();
            return $this->ResponseService->errorResponse($e, 500);
        }
    }
}
