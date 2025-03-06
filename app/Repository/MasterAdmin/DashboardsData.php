<?php

namespace App\Repository\MasterAdmin;

use App\Repository\AbstractMethod\RepositoryContract;
use Illuminate\Support\Carbon;
use App\Models\TrademarkUserModel;
use App\Models\AttorneysModel;
use App\Models\MainCategoryModel;
use App\Models\ConsultantModel;
use App\Models\SubcategoryModel;
use App\Models\UserPermissionModel;
use App\Models\CmsGroupPermissionModel;
use App\Repository\UserPermissionRepo;
use Illuminate\Support\Facades\Auth;


class DashboardsData extends RepositoryContract
{
    public function upcommingdates()
    {
        $startDate = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->addDays(15)->endOfDay();
        if (Auth::user()->role == 'superadmin') {
            $groupedData = TrademarkUserModel::with(['mainCategory:*', 'statusMain:*'])->get();
            $upcommingdates = [
                'Valid UpTo' => TrademarkUserModel::with([
                    'Clientonsultant:id,consultant_name',
                    'statusMain:id,status_name',
                    'mainCategory:id,category_name'
                ])
                ->whereBetween('valid_up_to', [$startDate, $endDate])->get(),
    
                'Opposition Hearing Date' => TrademarkUserModel::with([
                    'Clientonsultant:id,consultant_name',
                    'statusMain:id,status_name',
                    'mainCategory:id,category_name'
                ])->whereBetween('opposition_hearing_date', [$startDate, $endDate])->get(),
    
                'Hearing Date' => TrademarkUserModel::with([
                    'Clientonsultant:id,consultant_name',
                    'statusMain:id,status_name',
                    'mainCategory:id,category_name'
                ])->whereBetween('hearing_date', [$startDate, $endDate])->get(),

                'Evidence Last Date' => TrademarkUserModel::with([
                    'Clientonsultant:id,consultant_name',
                    'statusMain:id,status_name',
                    'mainCategory:id,category_name'
                ])->whereBetween('evidence_last_date', [$startDate, $endDate])->get(),
            ];
        } else {
            $loggedInUserId = Auth::user()->id;
    
            // Fetch all permission IDs assigned to the logged-in user
            $userPermissionIds = UserPermissionModel::where('user_id', $loggedInUserId)->pluck('permission_id');
    
            $userPermissionRepository = new UserPermissionRepo();
            $groupedData = TrademarkUserModel::with(['mainCategory:*', 'statusMain:*'])
                ->whereIn('attorney_id', $userPermissionRepository->getAtteorneys())
                ->get();
    
            $upcommingdates = [
                'Valid UpTo' => TrademarkUserModel::with([
                    'Clientonsultant:id,consultant_name',
                    'statusMain:id,status_name',
                    'mainCategory:id,category_name'
                ])->whereBetween('valid_up_to', [$startDate, $endDate])
                    ->whereIn('attorney_id', $userPermissionRepository->getAtteorneys())
                    ->get(),
    
                'Opposition Hearing Date' => TrademarkUserModel::with([
                    'Clientonsultant:id,consultant_name',
                    'statusMain:id,status_name',
                    'mainCategory:id,category_name'
                ])->whereBetween('opposition_hearing_date', [$startDate, $endDate])
                    ->whereIn('attorney_id', $userPermissionRepository->getAtteorneys())
                    ->get(),
    
                'Hearing Date' => TrademarkUserModel::with([
                    'Clientonsultant:id,consultant_name',
                    'statusMain:id,status_name',
                    'mainCategory:id,category_name'
                ])->whereBetween('hearing_date', [$startDate, $endDate])
                    ->whereIn('attorney_id', $userPermissionRepository->getAtteorneys())
                    ->get(),
            ];
        }
        return [
            'groupedData' => $groupedData,
            'upcommingdates' => $upcommingdates,
        ];
    }
}
