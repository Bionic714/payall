<?php

/**
 * Description of MemberController
 *
 * @author Yamada Yoseigi
 */

class MemberController extends BaseController {
    
    
    public function index(){
        $result = Mem::selectMemForDatalist()
                ->where('mb_mem.mb_mem_type', '=', '1')
                ->get();
        return View::make('member.index')
                ->with('result',$result)
                ->with('count',count($result));
    }
    
    
    public function create(){

    }
    
    
    public function store(){
       
    }
    
    
    public function show($id){
        
        $list_province = Province::lists('sys_province_name','sys_province_id');
        if( empty($list_province[0])){ $list_province[0] = ''; }
        $list_subprovince = Subprovince::lists('sys_subprovince_name','sys_subprovince_id');
        if( empty($list_subprovince[0])){ $list_subprovince[0] = ''; }
        $list_district = District::lists('sys_district_name','sys_district_id');
        if( empty($list_district[0])){ $list_district[0] = ''; }
        
        $result = Mem::find($id);
        return View::make('member.show')
                ->with('mem',$result)
                ->with('list_province',$list_province)
                ->with('list_subprovince',$list_subprovince)
                ->with('list_district',$list_district); 
    }
    
    
    public function edit(){

    }
    
    
    public function update(){
        
    }
    
    
    public function destroy($id){

        if($id=='delall'){
            $arrData = Input::get('hidden_chkBoxDel');
            if(!empty($arrData)){
                foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                Session::flash('message', 'ลบข้อมูลเรียบร้อยแล้ว');
                return Redirect::to('member');
            }else{
                Session::flash('message', 'ไม่พบข้อมูลที่ต้องการลบ');
                return Redirect::to('member');
            }   
        }else{       
            $this->delete($id);
            Session::flash('message', 'ลบข้อมูลเรียบร้อยแล้ว');
            return Redirect::to('member');
        }

    }
    
    private function delete ($id) {
        $member = Mem::find($id);
        $member->delete();
    }

   
}