<?php
namespace App\Models;
  
use App\Models\Hospital;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
	public function collection()
    {
        return Hospital::all();
    }
}
