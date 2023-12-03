<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\DTO\CashWithdrawDTO;
use App\Http\Requests\CashWithdrawRequest;
use App\Services\BankAccountService;
use App\Services\CashWithdrawService;
use App\Services\ResponseService;

class CashWithdrawController extends Controller
{
    const SUCCESS_MESSAGE =  'Saque realizado com sucesso';
    const OPERATION = 'withdraw';
    
    private $CashWithdrawService;

    public function __construct(){
        $this->BankAccountService = new BankAccountService();
        $this->CashWithdrawService = new CashWithdrawService();
        $this->ResponseService = new ResponseService();
    }

    public function withdraw(CashWithdrawRequest $request){
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $CashWithdraw = new CashWithdrawDTO($data);
            $this->CashWithdrawService->withdraw($CashWithdraw);
            DB::commit();
            Log::channel('bank_transition')->info(self::OPERATION, $data);
            return $this->ResponseService->successResponse(self::SUCCESS_MESSAGE);
        } catch (Exception $e) {
            Log::error([
                'function' => 'CashWithdrawController@withdraw',
                'error' => $e->getMessage(), 
                'data' => $data
            ]);
            DB::rollBack();
            return $this->ResponseService->errorResponse($e, 500);
        }
    }
}
