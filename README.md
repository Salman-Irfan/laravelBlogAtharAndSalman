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
        "token": "3|jUW945Q8ZinRAUhkTgsRNhU9dFhgc2ItvbjEkVCw9a813fde",
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