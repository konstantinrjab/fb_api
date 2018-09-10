<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <title>API documentation</title>
</head>
<body>
<div class="container-well">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">API documentation</h2>
                <p>base url: <?= $_SERVER['REMOTE_ADDR']; ?>/api/backend/</p>
                <p>return data type: json</p>
                <p class="text-center">Client endpoints</p>
                <table class="table table-bordered table-hover table-sm table-responsive">
                    <thead class="font-weight-bold">
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Type</th>
                        <th scope="col">Endpoint</th>
                        <th scope="col">Request parameters</th>
                        <th scope="col">Answer example</th>
                        <th scope="col">Answer explained</th>
                        <th scope="col">Http status code</th>
                        <th scope="col">Authorization</th>
                    </tr>
                    </thead>
                    <tbody valign="top">
                    <tr>
                        <th scope="row">Get access token</th>
                        <td>GET</td>
                        <td>/token/</td>
                        <td>login, password;<br>
                            all parameters required
                        </td>
                        <td>
                            {
                                "token": "string",<br>
                                "expire": "string"
                            }
                        </td>
                        <td>token: ''token" - access token;<br>
                            expire: "date" - the time to which the token is valid;</td>
                        <td>200 - ok;<br>
                            403 - Authorization error;
                        </td>
                        <td></td>
                    </tr>
                    <!--Add member-->
                    <tr>
                        <th scope="row">Add member</th>
                        <td>GET</td>
                        <td>add/member</td>
                        <td>token, user_id, name;<br>
                            all parameters required
                        </td>
                        <td>success</td>
                        <td>success - member was added;<br>
                            error: "Incorrect field" - incorrect or empty data in the field
                        </td>
                        <td>200 - OK;<br>
                            400 - Bad params;<br>
                            403 - Authorization error;
                        </td>
                        <td>auth token</td>
                    </tr>
                    <!--Update rating-->
                    <tr>
                        <th scope="row">Update member's rating</th>
                        <td>GET</td>
                        <td>update/rating/</td>
                        <td>token, user_id, name;<br>
                            all parameters required
                        </td>
                        <td>success</td>
                        <td>success - rating was updated;<br>
                            "error": "parameters missing\/not int" - incorrect or empty data in the field
                        </td>
                        <td>200 - OK;<br>
                            400 - Bad params;<br>
                            403 - Authorization error;
                        </td>
                        <td>auth token</td>
                    </tr>
                    <!--Get all records-->
                    <tr>
                        <th scope="row">Get all records</th>
                        <td>GET</td>
                        <td>get/</td>
                        <td>token - required</td>
                        <td>[
                            {
                            "user_id": "int",
                            "first_name": "string",
                            ...
                            },
                            ...
                            ]
                        </td>
                        <td>parameter: "value" - fields in database</td>
                        <td>200 - OK;<br>
                            400 - Bad params;<br>
                            403 - Authorization error;
                        </td>
                        <td>auth token</td>
                    </tr>
                    <!--Get random-->
                    <tr>
                        <th scope="row">Get two random girl</th>
                        <td>GET</td>
                        <td>get/random/</td>
                        <td>token - required</td>
                        <td>[
                            {
                            "user_id": "int",
                            "first_name": "string",
                            ...
                            },
                            ...
                            ]
                        </td>
                        <td>parameter: "value" - fields in database</td>
                        <td>200 - OK;<br>
                            400 - Bad params;<br>
                            403 - Authorization error;
                        </td>
                        <td>auth token</td>
                    </tr>
                    <!--Get member by parameters-->
                    <tr>
                        <th scope="row">Get member by parameters</th>
                        <td>GET</td>
                        <td>get/specified/</td>
                        <td> token - required;<br>
                            user_id, status, gender, order, limit, offset - optional
                        </td>
                        <td>[
                            {
                            "user_id": "int",
                            "first_name": "string",
                            ...
                            },
                            ...
                            ]
                        </td>
                        <td>parameter: "value" - fields in database</td>
                        <td>200 - OK;<br>
                            400 - Bad params;<br>
                            403 - Authorization error;
                        </td>
                        <td>auth token</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>