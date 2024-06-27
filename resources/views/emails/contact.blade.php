<html>

<body>
    <h2><b>Hello Admin: </b></h2>
    <h4><b>You Have Received A New Email : </b></h4>

    <br><br>

    <p><b>Full Name: </b>{{ $new_request->name }}</p>
    <p><b>Email: </b>{{ $new_request->email }}</p>
    <p><b>Phone Number: </b>{{ $new_request->phone_number }}</p>
    <p><b>Subject: </b>{{ $new_request->service->title }}</p>
    <p><b>Message: </b>{{ $new_request->message }}</p>

    <br><br>
</body>

</html>
