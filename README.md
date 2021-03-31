# Web Stranica

## TODO

* js error on blog post when not logged in

* Browser doesn't warn in the same way about wrong input on register page
* Sanitize user input

* Convert markdown to php on upload
    makes for faster loading
    doesn't allow for future updates to converter
    or store markdown and html versions in db? Don't think that one is good

* using current markdown [color: red; *css style* ]{ *what ever* }
  allows for more css style so I'm thing replace [color:*color*] with [style=*css styles*]
* Allow editing of posts

* Page should refresh after post update or update actual post on the page
  move view to the top after edit button clicked, imagine last post on the page edited, scroll all the way back

* blogGetRawPost.php should not block other users from reding raw post data

## Notes

* file_put_contents ( file , msg, FILE_APPEND | LOCK_EX);
* mysqli_error($dbConn)
* 
* echo date('Y-m-d H:i:s');


## This project uses resources from
    https://fontawesome.com/
