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

<!-- Public Route -->
<!-- email verification -->
<h3>Email Verification Route</h3>
<pre>
EmailVerification
Method:  Get
Endpoint: http://{{BASE_URL}}:8000/api/v1/send-verify-email/salmanirfan692@gmail.com
Response:
{
    "message": "Blog updated successfully",
    "blog": {
        "id": 4,
        "title": "title update",
        "description": "desc updated",
        "image": "blog_images/clay-banks-kiv1ggvkgqk-unsplash_blogThumbnail_1698115695.jpg",
        "isApproved": false,
        "category_id": 2,
        "user_id": 2,
        "created_at": "2023-10-24T02:48:15.000000Z",
        "updated_at": "2023-10-24T02:58:38.000000Z"
    }
}
</pre>

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
Get All Blogs by Admin
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

<!-- update blog status -->
<pre>
Approve Blog by Admin
Method:  Patch
Endpoint: http://10.0.10.187:8000/api/v1/admin/update-blog-status/3
Headers: Authorization: Bearer <Token>
Body:
{
    "isApproved": false
}
Response:
{
    "message": "Blog status updated successfully",
    "data": {
        "id": 3,
        "title": "Adventures in Travel",
        "description": "Embark on thrilling adventures and explore new places around the world.",
        "image": "pakistan.png",
        "isApproved": false,
        "category_id": 3,
        "user_id": 2,
        "created_at": "2023-10-19T08:25:39.000000Z",
        "updated_at": "2023-10-19T09:55:16.000000Z"
    }
}
</pre>


</pre>

<!-- update blog status -->
<pre>
Create Blog Category
Method:  Patch
Endpoint: http://10.0.10.187:8000/api/v1/admin/add-category
Headers: Authorization: Bearer <Token>
Body:
{
    "name": Health
}
Response:
{
    "message": "Category added successfully",
    "category": {
        "name": "Travels",
        "isChild": null,
        "updated_at": "2023-10-27T05:04:20.000000Z",
        "created_at": "2023-10-27T05:04:20.000000Z",
        "id": 6
    }
}
</pre>


<!-- public routes -->
<h3>Public Routes</h3>
<pre>
Get all Approved Blogs
Method:  Get
Endpoint: http://10.0.10.187:8000/api/v1/public/all-users-blogs


Response:
[
    {
        "id": 8,
        "title": "from postman 3",
        "description": "description from postman form data 3",
        "image": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAMAAADDpiTIAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAACDPAAAgzwGxSQ44AAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+...",
        "isApproved": 1,
        "category_id": 2,
        "user_id": 2,
        "created_at": "2023-10-19 11:53:20",
        "updated_at": "2023-10-19 12:19:52"
    },
    
]
</pre>

<!-- User Role -->
<h3>User Route</h3>
<pre>
Create Blog
Method:  Post
Endpoint: http://10.0.10.187:8000/api/v1/user/create-blog
Headers: Authorization Bearer <"Token">
Input: title, description, image, category_id
Response:
{
    "message": "Blog created successfully",
    "blog": {
        "title": "request separated",
        "description": "description from postman form data 3",
        "category_id": "2",
        "user_id": 2,
        "image": "blog_images/gmail_blogThumbnail_1698034918.png",
        "updated_at": "2023-10-23T04:21:58.000000Z",
        "created_at": "2023-10-23T04:21:58.000000Z",
        "id": 16
    }
}
</pre>

<!-- User Role -->
<h3>User Route</h3>
<pre>
Create Comment
Method:  Post
Endpoint: http://10.0.10.187:8000/api/v1/user/create-comment
Headers: Authorization Bearer <"Token">
Input: comment, blog_id
Response:
{
    "message": "Comment created successfully",
    "comment": {
        "comment": "this is a test comment",
        "blog_id": "17",
        "user_id": 2,
        "updated_at": "2023-10-23T04:58:13.000000Z",
        "created_at": "2023-10-23T04:58:13.000000Z",
        "id": 4
    }
}
</pre>

<h3>Public Route</h3>
<pre>
Get Blog by Id with All Details
Method:  Get
Endpoint: http://10.0.10.187:8000/api/v1/public/get-blog/5
Response:
{
    "blog": {
        "blog_id": 4,
        "blog_title": "Ryunosoke",
        "blog_image": "data:image/jpg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/4gxYS5u3VpjcfZ/ctpEF6/wB9.",
        "blog_category_id": 2,
        "blog_category_name": "laravel",
        "blog_timestamps": "2023-10-23 08:10:08",
        "user_name": "user",
        "comments": [
            {
                "comment_id": 12,
                "comment": "this is a test comment",
                "user_id": 2,
                "user_name": "user",
                "comment_timestamps": "2023-10-23 08:13:01"
            },
            {
                "comment_id": 13,
                "comment": "this is a test comment",
                "user_id": 2,
                "user_name": "user",
                "comment_timestamps": "2023-10-23 08:13:05"
            },
            {
                "comment_id": 14,
                "comment": "this is a test comment",
                "user_id": 2,
                "user_name": "user",
                "comment_timestamps": "2023-10-23 08:13:07"
            }
        ]
    }
}
</pre>

<!-- User Role -->
<h3>User Route</h3>
<pre>
Delete Comment
Method:  Delete
Endpoint: http://10.0.10.187:8000/api/v1/user/delete-comment/12
Headers: Authorization Bearer <"Token">

Response:
{
  "message": "Comment deleted successfully",
  "comment": {
    "id": 14,
    "comment": "this is a test comment",
    "blog_id": 4,
    "user_id": 2,
    "created_at": "2023-10-23T08:13:07.000000Z",
    "updated_at": "2023-10-23T08:13:07.000000Z"
  }
}
</pre>

<!-- User Role -->
<h3>User Route</h3>
<pre>
Update Blog
Method:  Delete
Endpoint: http://10.0.10.187:8000/api/v1/user/update-blog/4
Input: title, description, image, category_id
Headers: Authorization Bearer <"Token">

Response:
{
    "message": "Blog updated successfully",
    "blog": {
        "id": 4,
        "title": "title update",
        "description": "desc updated",
        "image": "blog_images/clay-banks-kiv1ggvkgqk-unsplash_blogThumbnail_1698115695.jpg",
        "isApproved": false,
        "category_id": 2,
        "user_id": 2,
        "created_at": "2023-10-24T02:48:15.000000Z",
        "updated_at": "2023-10-24T02:58:38.000000Z"
    }
}
</pre>

<!-- User Role -->
<h3>User Profile Route</h3>
<pre>
Get User 
Method:  Get
Endpoint: http://10.0.10.187:8000/api/v1/user/profile
Headers: Authorization Bearer <"Token">

Response:
{
    "user": {
        "name": "Salman Irfan",
        "email": "salmanirfan692@gmail.com"
    },
    "blogs": [
        {
            "title": "The Top 10 Hotels in Europe for an Unforgettable Experience",
            "description": "Europe, with its rich history, diverse culture, and stunning landscapes, is a dream destination for travelers from around the world. When it comes to accommodation"
            "image": "blog_images/hotels_blogThumbnail_1698217145.jpg",
            "isApproved": 0,
            "category_id": 3,
            "created_at": "2023-10-25 06:59:05"
        }
    ]
}
</pre>