<?php
define('TABLE_NAME', 'emp');

#empGet : select data of emp
if (!function_exists('empGet')) {
    function empGet($id = '')
    {

        $headers = ['Content-Type' => 'application/json;charset=utf-8', 'hasToken' => false];
        $response = ['json'];
        $params = ['single' => '/api/emp/$id', 'All Records' => '/api/emp'];

        if (empty($id)) {

            $query = new Query();
            $data = $query->select(TABLE_NAME)->commit()->getAllRecords();
            if (count($data) > 0) {

                echo json_encode([
                    'code' => 200,
                    'message' => $query->getSuccessMessage(),
                    'status' => true,
                    'error' => false,
                    'data' => $data,
                ], JSON_PRETTY_PRINT);
                exit();
            } else {
                echo json_encode([
                    'code' => 201,
                    'message' => $query->getErrorMessage(),
                    'status' => true,
                    'error' => false,
                    'data' => $data,
                ], JSON_PRETTY_PRINT);
                exit();

            }

        } else {

            $query = new Query();
            $data = $query->select(TABLE_NAME)->where('id', '=', $id)->commit()->getRow();
            if (count($data) > 0) {

                echo json_encode([
                    'code' => 200,
                    'message' => $query->getSuccessMessage(),
                    'status' => true,
                    'error' => false,
                    'data' => $data,
                ], JSON_PRETTY_PRINT);
                exit();
            } else {
                echo json_encode([
                    'code' => 201,
                    'message' => $query->getErrorMessage(),
                    'status' => true,
                    'error' => false,
                    'data' => $data,
                ], JSON_PRETTY_PRINT);
                exit();

            }

        }








    }
}

#empPost : Insert data of emp
if (!function_exists('empPost')) {
    function empPost()
    {
        $fillable = ['name', 'email', 'password', 'mobile', 'dept', 'salary'];
        $headers = ['Content-Type' => 'application/json;charset=utf-8', 'hasToken' => false];
        $response = ['json'];

        $formdata = getRawData();
        $formdata['password'] = password_hash($formdata['password'], PASSWORD_BCRYPT);
        $query = new Query();
        $check = $query->insert(TABLE_NAME, $formdata)->commit();
        if ($check) {
            $newId = $query->getInsertedID();
            $userData = $query->select(TABLE_NAME)->where('id', '=', $newId)->commit()->getRow();
            echo json_encode([
                'code' => 200,
                'message' => 'Record Inserted Successfully',
                'error' => false,
                'status' => true,
                'data' => $userData,
            ], JSON_PRETTY_PRINT);
        } else {
            echo json_encode([
                'code' => 201,
                'message' => $query->getErrorMessage(),
                'error' => false,
                'status' => true,
                'data' => [],
            ], JSON_PRETTY_PRINT);
        }







    }
}

#empPut : Update data of emp
if (!function_exists('empPut')) {
    function empPut($id = '')
    {
        $fillable = ['name', 'email', 'mobile', 'dept', 'salary'];
        $headers = ['Content-Type' => 'application/json;charset=utf-8', 'hasToken' => false];
        $response = ['json'];
        $params = ['single record update' => '/api/emp/$id'];

        //id is empty or not
        if (empty($id)) {

            echo json_encode([
                'code' => 201,
                'message' => 'Id is Required',
                'error' => true,
                'status' => true,
                'data' => [],
            ], JSON_PRETTY_PRINT);
            exit();
        }
        $formdata = getRawData();
        //passowrd allowed not
        if (array_key_exists('password', $formdata)) {
            echo json_encode([
                'code' => 201,
                'message' => 'Password Field cannot be Updated Please Remove',
                'error' => true,
                'status' => true,
                'data' => [],
            ], JSON_PRETTY_PRINT);
            exit();
        }

        //check if Id exist or not
        $query = new Query();
        $count = $query->select(TABLE_NAME)->where('id', '=', $id)->commit()->count();
        if ($count == 0) {
            echo json_encode([
                'code' => 201,
                'message' => 'Update Error, Record Not Found for Id =' . $id,
                'error' => true,
                'status' => true,
                'data' => [],
            ], JSON_PRETTY_PRINT);
            exit();
        }

        $check = $query->update(TABLE_NAME, $formdata)->where('id', '=', $id)->commit();
        if ($check) {


            $query = new Query();
            $updateColumns = array_keys($formdata);
            $updateUserData = $query->select(TABLE_NAME, $updateColumns)
                ->where('id', '=', $id)->commit()->getRow();
            echo json_encode([
                'code' => 200,
                'message' => 'Record Updated Successfully',
                'error' => false,
                'status' => true,
                'data' => $updateUserData,
            ], JSON_PRETTY_PRINT);
            exit();
        } else {

            echo json_encode([
                'code' => 201,
                'message' => 'Record Cannot Updated',
                'error' => true,
                'status' => true,
                'data' => [],
            ], JSON_PRETTY_PRINT);
            exit();
        }





    }
}

#empDelete : Delete data of emp
if (!function_exists('empDelete')) {
    function empDelete($id = '')
    {

        $headers = ['Content-Type' => 'application/json;charset=utf-8', 'hasToken' => false];
        $response = ['json'];
        $params = ['Single record Delete' => '/api/emp/$id'];

        $message = '';
        if (empty($id)) {
            $message = 'Id is Required';
            echo json_encode([
                'code' => 201,
                'message' => $message,
                'error' => true,
                'status' => true,
                'data' => [],
            ], JSON_PRETTY_PRINT);

        }

        if (!empty($id)) {
            $query = new Query();
            $count = $query->select(TABLE_NAME)->where('id', '=', $id)->commit()->count();
            if ($count == 0) {
                echo json_encode([
                    'code' => 201,
                    'message' => 'Delete Error, No Record Found for Id = ' . $id,
                    'error' => true,
                    'status' => true,
                    'data' => [],
                ], JSON_PRETTY_PRINT);
                exit();
            }
            $check = $query->delete(TABLE_NAME, ['id' => $id])->commit();
            if ($check) {

                echo json_encode([
                    'code' => 200,
                    'message' => $query->getSuccessMessage(),
                    'error' => false,
                    'status' => true,
                    'data' => [],
                ], JSON_PRETTY_PRINT);

            } else {
                echo json_encode([
                    'code' => 201,
                    'message' => $query->getErrorMessage(),
                    'error' => false,
                    'status' => true,
                    'data' => [],
                ], JSON_PRETTY_PRINT);
            }
        }










    }
}




?>