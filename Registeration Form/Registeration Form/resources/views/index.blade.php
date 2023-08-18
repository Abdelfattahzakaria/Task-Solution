<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Registeration Page</title>

    <!-- Main CSS-->
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    @include('alerts.errors')
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="mainContainer">
            <div class="wrapper wrapper--w900">
                <div class="card card-6">
                    <div class="card-heading">
                        <h2 class="title">Apply for job</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('UserRegisterationStore')}}" enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <div class="form-row">
                                <div class="name">First Name</div>
                                <div class="value">
                                    <input class="input--style-6" type="text" name="fname" placeholder="please enter your last name">
                                    @error('fname')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Last Name</div>
                                <div class="value">
                                    <div class="input-group">
                                        <input class="input--style-6" type="text" name="lname" placeholder="please enter your last name">
                                    </div>
                                    @error('lname')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="name">Upload Your Photo</div>
                                <div class="value">
                                    <div class="input-group js-input-file">
                                        <input class="input-file" type="file" name="photo" id="file" onchange="fileValidation()">
                                        <label class="label--file" for="file">Choose file</label>
                                        <span class="input-file__info">No file chosen</span>
                                    </div>
                                    @error('photo')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <div class="label--desc">Upload your photo/Resume or any other relevant file. Max file size 50 MB</div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn--radius-2 btn--blue-2" type="submit">Send Application</button>
                            </div>
                        </form>
                    </div>
                    <center><div id="imagePreview"></div></center>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>

    <!-- Main JS-->
    <script src="{{asset('assets/js/global.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if(Session::has('data'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.success("{{Session::get('data')}}", "success!", {
            timeOut: 12000
        });
    </script>
    @endif

    <script>
        function fileValidation() {
            var fileInput =
                document.getElementById('file');

            var filePath = fileInput.value;

            // Allowing file type
            var allowedExtensions =
                /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                fileInput.value = '';
                return false;
            } else {

                // Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                                'imagePreview').innerHTML =
                            '<img style="width:50%;" src="' + e.target.result +
                            '"/>';
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            }  
        }
    </script> 
      

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
 
