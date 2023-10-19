master -> main -> development -> SalmanIrfan

<!-- APIs -->
<h1>Laravel Blog Post System APIs</h1>

<h2> User Auth with Spatie Roles and Permissions</h2>

<!-- Register user -->
<pre>
BASE_URL = http://10.0.10.187:8000/api
</pre>
<h4>Register User</h4>
<pre>
endpoint: /v1/register
method: post
headers: none
</pre>

<table>
  <thead>
    <tr>
    <!-- table headers -->
      <th>Request</th>
      <th>Response</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <pre>
        <!-- request -->
{
    "name": "user one",
    "email" : "userone@user.com",
    "password" : "password"
}
        </pre>
      </td>
      <td>
        <pre>
        <!-- response -->
{
    "data": {
        "user_id": 3,
        "name": "user one",
        "email": "userone@user.com",
        "roles": [
            "user"
        ],
        "roles.permissions": [
            "canCreateBlog",
            "canUpdateBlog",
            "canDeleteBlog",
            "canSeeAllBlogs",
            "canCommentOnBlogs"
        ],
        "permissions": [],
        "email_verified_at": null,
        "created_at": "2023-10-17T11:18:23.000000Z",
        "updated_at": "2023-10-17T11:18:23.000000Z"
    }
}
        </pre>
      </td>
    </tr>
  </tbody>
</table>

<!-- login -->

<h4>Login User</h4>
<pre>
endpoint: /v1/login
method: post
headers: none
</pre>

<table>
  <thead>
    <tr>
    <!-- table headers -->
      <th>Request</th>
      <th>Response</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <pre>
        <!-- request -->
{
    "email" : "admin@admin.com",
    "password" : "password"
}
        </pre>
      </td>
      <td>
        <pre>
        <!-- response -->
{
    "data": {
        "user_id": 1,
        "name": "Admin",
        "email": "admin@admin.com",
        "token": "1|QCOZ9bYYnvRqcEJKkcnr3Y2uNCjjtbMTyEgqTHPse1067711",
        "roles": [
            "admin"
        ],
        "roles.permissions": [
            "canViewAllUsers",
            "canDeleteUser"
        ],
        "permissions": [],
        "email_verified_at": null,
        "created_at": "2023-10-17T11:12:46.000000Z",
        "updated_at": "2023-10-17T11:12:46.000000Z"
    }
}
        </pre>
      </td>
    </tr>
  </tbody>
</table>

<!-- dev branch -->
<!-- branch Salman -->

<h3>Admin Apis</h3>
<pre>
Get All Users
Method:  GET
Endpoint: http://10.0.10.187:8000/api/v1/admin/get-all-users
Headers: Authorization: Bearer <Token>
Response:
[
  {
    "id": 1,
    "name": "Admin",
    "email": "admin@admin.com",
    "email_verified_at": null,
    "created_at": "2023-10-18 09:37:44",
    "updated_at": "2023-10-18 09:37:44"
  },
  {
    "id": 2,
    "name": "user",
    "email": "user@user.com",
    "email_verified_at": null,
    "created_at": "2023-10-18 09:37:44",
    "updated_at": "2023-10-18 09:37:44"
  },
]
</pre>

<!-- delete user -->
<pre>
Delete user by Id

Method:  Delete
Endpoint: http://10.0.10.187:8000/api/v1/admin/delete-user/13
Headers: Authorization: Bearer <Token>
Response:
{
    "message": "User deleted successfully",
    "user": {
        "id": 13,
        "name": "user five",
        "email": "userfive@user.com",
        "email_verified_at": null,
        "remember_token": null,
        "created_at": "2023-10-19 05:33:48",
        "updated_at": "2023-10-19 05:33:48"
    }
}
</pre>

<!-- admin - blogs -->

<pre>
Get All Blogs
Method:  GET
Endpoint: http://10.0.10.187:8000/api/v1/admin/all-blogs
Headers: Authorization: Bearer <Token>
Response:
[
    {
        "id": 1,
        "title": "The World of Programming",
        "description": "Explore the exciting world of programming and coding.",
        "image": "programming.png",
        "isApproved": 1,
        "category_id": 1,
        "user_id": 2,
        "created_at": "2023-10-19 08:25:39",
        "updated_at": "2023-10-19 08:25:39"
    },
    {
        "id": 3,
        "title": "Adventures in Travel",
        "description": "Embark on thrilling adventures and explore new places around the world.",
        "image": "pakistan.png",
        "isApproved": 0,
        "category_id": 3,
        "user_id": 2,
        "created_at": "2023-10-19 08:25:39",
        "updated_at": "2023-10-19 09:55:16"
    }
]
</pre>

