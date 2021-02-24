// เกมส์ ทดสอบข้อมูล 
    public function data_table_set_json(){
        $modelDatatable = $this->Member->ShowListsMember();
        $column = Schema::getColumnListing('users');
        $object = new stdClass;
        foreach($modelDatatable as $key=> $datas)
        {
             $object->data[$key]=new stdClass;
        }
        foreach ($column as $columns) {
            foreach($modelDatatable as $key=> $datas)
            {
                 $object->data[$key]->$columns = $datas[$columns];
            }
        }
        return response()->json($object); 
    }
