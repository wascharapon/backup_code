
//  ทดสอบตารางข้อมูล  เกมส์ 02/23/21
Route::get('test', function () {

    return  view('test_view.phpgetjson');
 });
 Route::get('test_data', 'MemberController@data_table_set_json'); //ข้อมูล
 Route::get('member_test', function () {
    return  view('test_view.member_test');
 });
//  END ทดสอบตารางข้อมูล
