<?php
use Modules\Settings\Entities\Settings;
use App\Models\User;
use Modules\Clients\Entities\Client;
use Modules\Desks\Entities\Desk;
use Modules\Logs\Entities\Logs;
use Modules\Stock\Entities\Stock;
use Modules\Venders\Entities\Venders;
use Modules\Filters\Entities\Filters;
use Modules\School\Entities\School;
use Modules\Logs\Entities\SystemLogs;
use Modules\Plants\Entities\Plants;
use Modules\Country\Entities\Country;
use Modules\State\Entities\State;
use Modules\Districts\Entities\Districts;
use Illuminate\Support\Facades\Http;
function AllPermissions()
{
	$role=[];
	$role['users']=['view','add','edit','delete'];
	$role['school']=['view','add','edit','delete'];
	$role['filters']=['view','add','edit','delete'];
	$role['plants']=['view','add','edit','delete'];
	$role['venders']=['view','add','edit','delete'];
	$role['stock']=['view','add','edit','delete'];
	$role['permissions']=['view','add','edit','delete'];
	$role['trash']=['view','edit','delete'];	
	$role['logs']=['view','delete'];	
    $role['settings']=['view','add','edit','delete'];
	$role['water-test-quality-parameter']=['view','add','edit','delete'];

return $role;

}


function FileUpload($file, $path){
	if($file==null){return null;}
	 $imgname=$file->getClientOriginalName();
	  if($file->move($path,$imgname)){
	  	return $imgname;
	  }
	  else{
	  	return null;
	  }
}



function Base64FileUpload($file, $path){
	if($file==null){return null;}
		$png =uniqid().date('Y-m-d-H-i-s')."base64images.png";
    		$path = $path.'/'.$png;
    		$uploadimg=Image::make(file_get_contents($file))->save($path);
    		if(isset($uploadimg->basename)){
    			return $uploadimg->basename;
    		}    
	 
}


function Settings()
{
	return Settings::first();
}



function User($id)
{
	$user=User::find($id);
	if($user!=null){
		return $user->name;
	}
}

function Venders($id)
{
    $vender=Venders::find($id);
    if($vender!=null){
        return $vender->name;
    }
}


function FocalPersonRelation()
{
    $rel=[
        'teacher'=>'School Teacher',
        'head_teacher'=>'Head Master/Principal',
        'volunteer'=>'Volunteer',

    ];

    return $rel;
}

function SchoolGender()
{
    $sg=[
        'boys'=>'Boys',
        'girls'=>'Girls',
        'co-education'=>'Co-Education'
    ];

    return $sg;
}

function Filter($id)
{
    $filter=Filters::find($id);
    if($filter!=null){
        return $filter->name;
    }
}

function Plants($id)
{
    $plant=Plants::find($id);
    if($plant!=null){
        return $plant->name;
    }
}


function Country($id)
{
    $country=Country::find($id);
    if($country!=null){
        return $country->name;
    }
}


function State($id)
{
    $state=State::find($id);
    if($state!=null){
        return $state->name;
    }
}


function Districts($id)
{
    $des=Districts::find($id);
    if($des!=null){
        return $des->name;
    }
}



function School($id)
{
    $school=School::find($id);
    if($school!=null){
        return $school->name;
    }
}



function UserDetail($id)
{
	$user=User::find($id);
	if($user!=null){
		return $user;
	}
}



function MenuSearchBar()
{
	$sidebarmenu=[
				'Dashboard'=>[
					['name'=>'Dashboard','link'=>url('home')],
				],
				'Users'=>[
					['name'=>'Users','link'=>url('users')],
					['name'=>'Roles & Permissions','link'=>url('roles')],
				],
				'Settings'=>[
					['name'=>'Settings','link'=>url('settings')],
				],
	];

return $sidebarmenu;

}



function GenerateOTP()
{
	return rand(1000,9999);
}



function SendMessage($phone, $msg)
{


	return true;

}



function GenerateLog($info)
{
	if(!Settings()->logging){
		return true;
	}

	if(Logs::insert($info)){
		return true;
	}
	else{
		return false;
	}
}


function GenerateSystemLog($info)
{
	if(SystemLogs::insert($info)){
		return true;
	}
	else{
		return false;
	}
}



function TrashModules()
{
	$modules=[];

	$modules=[
			[
				'name'=>'Users',
				'model'=>'users',
			],

	];

	return $modules;
}

function ApiCall($type='get', $url, $data)
{	
	$response = $type=="get" ? Http::get($url, $data) : Http::post($url, $data);
	$res=['success'=>$response->successful(), 'data'=>$response->body()];

	return (object) $res;

}

function ColorsPack()
{
	return ['#006BA6','#E33932','#F8A101','#F77C0C','#B3234E','#890D53','#601071', '#3B1585','#6891B1','#05B4C9','#00C3A7','#00C76F'];
}


function FilterFrequency(){
$Filter_Change_Frequency = [
    'monthly'=>'Monthly',   
    'bimonthly'=>'Bi-monthly',
    'trimonthly'=>'Tri-monthly',
    'quarterly'=>'Quarterly',
    'semiyearly'=>'Semi-yearly',
    'halfyearly'=>'Half-Yearly',
    'yearly'=>'Yearly',
];

	return $Filter_Change_Frequency;	
}

function ProvincesDistricts()
{
	$pd='{
        "Azad Kashmir": [
            {"Name":"Bagh", "countryCode":"PK"},
            {"Name":"Bhimber", "countryCode":"PK"},
            {"Name":"Hattian Bala", "countryCode":"PK"},
            {"Name":"Haveli", "countryCode":"PK"},
            {"Name":"Kotli", "countryCode":"PK"},
            {"Name":"Mirpur", "countryCode":"PK"},
            {"Name":"Muzzafarabad", "countryCode":"PK"},
            {"Name":"Neelum Valley", "countryCode":"PK"},
            {"Name":"Rawalkot", "countryCode":"PK"},
            {"Name":"Sudhanoti", "countryCode":"PK"}
        ],
        "Balochistan": [
            {"Name":"Awaran", "countryCode":"PK"},
            {"Name":"Barkhan", "countryCode":"PK"},
            {"Name":"Chagai", "countryCode":"PK"},
            {"Name":"Chaman", "countryCode":"PK"},
            {"Name":"Dera Bugti", "countryCode":"PK"},
            {"Name":"Gawadar", "countryCode":"PK"},
            {"Name":"Harnai", "countryCode":"PK"},
            {"Name":"Jafarabad", "countryCode":"PK"},
            {"Name":"Kacchi", "countryCode":"PK"},
            {"Name":"Kalat", "countryCode":"PK"},
            {"Name":"Kech", "countryCode":"PK"},
            {"Name":"Kharan", "countryCode":"PK"},
            {"Name":"Khuzdar", "countryCode":"PK"},
            {"Name":"Killa Abdullah", "countryCode":"PK"},
            {"Name":"Kila Saifullah", "countryCode":"PK"},
            {"Name":"Kohlu", "countryCode":"PK"},
            {"Name":"Lasbela", "countryCode":"PK"},
            {"Name":"Lehri", "countryCode":"PK"},
            {"Name":"Loralai", "countryCode":"PK"},
            {"Name":"Mastung", "countryCode":"PK"},
            {"Name":"Nasirabad", "countryCode":"PK"},
            {"Name":"Nushki", "countryCode":"PK"},
            {"Name":"Panjgur", "countryCode":"PK"},
            {"Name":"Pishi Valley", "countryCode":"PK"},
            {"Name":"Quetta", "countryCode":"PK"},
            {"Name":"Sherani", "countryCode":"PK"},
            {"Name":"Sibi", "countryCode":"PK"},
            {"Name":"Sohbatpur", "countryCode":"PK"},
            {"Name":"Washuk", "countryCode":"PK"},
            {"Name":"Zhob", "countryCode":"PK"},
            {"Name":"Ziarat", "countryCode":"PK"}
        ],
        "Gilgit Baltistan": [
            {"Name":"Astore", "countryCode":"PK"},
            {"Name":"Chilas", "countryCode":"PK"},
            {"Name":"Darel", "countryCode":"PK"},
            {"Name":"Diamer", "countryCode":"PK"},
            {"Name":"Ghanche", "countryCode":"PK"},
            {"Name":"GHizer", "countryCode":"PK"},
            {"Name":"Gilgit", "countryCode":"PK"},
            {"Name":"Gojal Upper Hunza", "countryCode":"PK"},
            {"Name":"Gupis Yasin", "countryCode":"PK"},
            {"Name":"Kharmang", "countryCode":"PK"},
            {"Name":"Rondu", "countryCode":"PK"},
            {"Name":"Shigar", "countryCode":"PK"},
            {"Name":"Skardu", "countryCode":"PK"},
            {"Name":"Tangir", "countryCode":"PK"}
        ],
        "Khyber PakhtoonKhwa": [
            {"Name":"Abbottabad", "countryCode":"PK"},
            {"Name":"Bajaur Agency", "countryCode":"PK"},
            {"Name":"Bannu", "countryCode":"PK"},
            {"Name":"Battagram", "countryCode":"PK"},
            {"Name":"Buner", "countryCode":"PK"},
            {"Name":"Charsadda", "countryCode":"PK"},
            {"Name":"Chitral", "countryCode":"PK"},
            {"Name":"Dera Ismail Khan", "countryCode":"PK"},
            {"Name":"Dir", "countryCode":"PK"},
            {"Name":"Hangu", "countryCode":"PK"},
            {"Name":"Haripur", "countryCode":"PK"},
            {"Name":"Karak", "countryCode":"PK"},
            {"Name":"Khyber Agency", "countryCode":"PK"},
            {"Name":"Kohat", "countryCode":"PK"},
            {"Name":"Kohistan", "countryCode":"PK"},
            {"Name":"Kurram Agency", "countryCode":"PK"},
            {"Name":"Lakki Marwat", "countryCode":"PK"},
            {"Name":"Malakand", "countryCode":"PK"},
            {"Name":"Mansehra", "countryCode":"PK"},
            {"Name":"Mardan", "countryCode":"PK"},
            {"Name":"Muhmad Agency", "countryCode":"PK"},
            {"Name":"North Waziristan Agency", "countryCode":"PK"},
            {"Name":"Nowshera", "countryCode":"PK"},
            {"Name":"Peshawar", "countryCode":"PK"},
            {"Name":"Shangal", "countryCode":"PK"},
            {"Name":"South Waziristan Agency", "countryCode":"PK"},
            {"Name":"Swabi", "countryCode":"PK"},
            {"Name":"Swat", "countryCode":"PK"},
            {"Name":"Tank", "countryCode":"PK"},
            {"Name":"Torghar", "countryCode":"PK"}
        ],
        "Punjab": [
            {"Name":"Ahmedpur East", "countryCode":"PK"},
            {"Name":"Attock", "countryCode":"PK"},
            {"Name":"Bhawalnagar", "countryCode":"PK"},
            {"Name":"Bahawalpur", "countryCode":"PK"},
            {"Name":"Bhakkar", "countryCode":"PK"},
            {"Name":"Chakwal", "countryCode":"PK"},
            {"Name":"Chichawatni", "countryCode":"PK"},
            {"Name":"Chiniot", "countryCode":"PK"},
            {"Name":"Dera Ghazi Khan", "countryCode":"PK"},
            {"Name":"Faisalabad", "countryCode":"PK"},
            {"Name":"Gujranwala", "countryCode":"PK"},
            {"Name":"Gujrat", "countryCode":"PK"},
            {"Name":"Hafizabad", "countryCode":"PK"},
            {"Name":"Islamabad", "countryCode":"PK"},
            {"Name":"Jhang", "countryCode":"PK"},
            {"Name":"Jhelum", "countryCode":"PK"},
            {"Name":"Kala Bagh", "countryCode":"PK"},
            {"Name":"Kallar Kahar", "countryCode":"PK"},
            {"Name":"Kasur", "countryCode":"PK"},
            {"Name":"Khanewal", "countryCode":"PK"},
            {"Name":"Khushab", "countryCode":"PK"},
            {"Name":"Lahore", "countryCode":"PK"},
            {"Name":"Layyah", "countryCode":"PK"},
            {"Name":"Lodhran", "countryCode":"PK"},
            {"Name":"Mandi Bahauddin", "countryCode":"PK"},
            {"Name":"Mianwali", "countryCode":"PK"},
            {"Name":"Minchinabad", "countryCode":"PK"},
            {"Name":"Multan", "countryCode":"PK"},
            {"Name":"Murree", "countryCode":"PK"},
            {"Name":"Muzaffargarh", "countryCode":"PK"},
            {"Name":"Nankana Sahib", "countryCode":"PK"},
            {"Name":"Narowal", "countryCode":"PK"},
            {"Name":"Okara", "countryCode":"PK"},
            {"Name":"Pakpatan", "countryCode":"PK"},
            {"Name":"Rahimyar Khan", "countryCode":"PK"},
            {"Name":"Rajanpur", "countryCode":"PK"},
            {"Name":"Rawalpindi", "countryCode":"PK"},
            {"Name":"Sahiwal", "countryCode":"PK"},
            {"Name":"Sargodha", "countryCode":"PK"},
            {"Name":"Shakargarh", "countryCode":"PK"},
            {"Name":"Sheikhupura", "countryCode":"PK"},
            {"Name":"Sialkot", "countryCode":"PK"},
            {"Name":"Toba Tek Singh", "countryCode":"PK"},
            {"Name":"Uch Sharif", "countryCode":"PK"},
            {"Name":"Vehari", "countryCode":"PK"}
          
        ],
        "Sindh": [
            {"Name":"Badin", "countryCode":"PK"},
            {"Name":"Dadu", "countryCode":"PK"},
            {"Name":"Ghotki", "countryCode":"PK"},
            {"Name":"Hyderabad", "countryCode":"PK"},
            {"Name":"Jacobabad", "countryCode":"PK"},
            {"Name":"Jamshoro", "countryCode":"PK"},
            {"Name":"Karachi", "countryCode":"PK"},
            {"Name":"Kashmore", "countryCode":"PK"},
            {"Name":"Khairpur", "countryCode":"PK"},
            {"Name":":Larkana", "countryCode":"PK"},
            {"Name":"Matiari", "countryCode":"PK"},
            {"Name":"Qambar Shahdakot", "countryCode":"PK"},
            {"Name":"Sanghar", "countryCode":"PK"},
            {"Name":"Shaheed Benazirabad", "countryCode":"PK"},
            {"Name":"Shikarpur", "countryCode":"PK"},
            {"Name":"Sujawal", "countryCode":"PK"},
            {"Name":"Sukkur", "countryCode":"PK"},
            {"Name":"Tando Allahyar", "countryCode":"PK"},
            {"Name":"Tando Muhammad Khan", "countryCode":"PK"},
            {"Name":"Tharparkar", "countryCode":"PK"},
            {"Name":"Thatta", "countryCode":"PK"},
            {"Name":"Umerkot", "countryCode":"PK"}
        ]
		}';


		return $pd;

}


