<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\DTO\CashTransferDTO;
use App\Http\Requests\CashTransferRequest;
use App\Services\BankAccountService;
use App\Services\CashTransferService;
use App\Services\ResponseService;

class CashTransferController extends Controller
{
    const SUCCESS_MESSAGE =  'Transferencia realizado com sucesso';
    const OPERATION = 'transfer';
    
    private $CashTransferService;

    public function __construct(){
        $this->BankAccountService = new BankAccountService();
        $this->CashTransferService = new CashTransferService();
        $this->ResponseService = new ResponseService();
    }

    public function transfer(CashTransferRequest $request){
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $cashTransfer = new CashTransferDTO($data);
            $this->CashTransferService->transfer($cashTransfer);
            DB::commit();
            Log::channel('bank_transition')->info(self::OPERATION, $data);
            return $this->ResponseService->successResponse(self::SUCCESS_MESSAGE);
        } catch (Exception $e) {
            Log::error([
                'function' => 'CashTransferController@transfer',
                'error' => $e->getMessage(), 
                'data' => $data
            ]);
            DB::rollBack();
            return $this->ResponseService->errorResponse($e, 500);
        }
    }
}
