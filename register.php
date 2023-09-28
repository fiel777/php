<?php
require 'config.php';

//session 
session_start();

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    header("Location: index.php");
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial- cale=1">
    <title>Crud Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/01d1b52149.js" crossorigin="anonymous"></script>
    <script src="register.js" type="text/javascript" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(() => {

            $("#backbtn").click(function() {
                $("#validation").css("display", "none");
            })

            $("#registration_form").submit(function(e) {
                e.preventDefault();

                const login_input = $("#login_email").val();
                const login_password = $("#login_password").val();
                const login_cpassword = $("#reg_confirmPassword").val();

                if (login_password != login_cpassword) {
                    $("#validation").html("Password does not match");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "database/createUser.php",
                        data: $(this).serialize(),
                        success: (result, status, xhr, ) => {
                            if (xhr.status === 200) {
                                $("#validation").css("color", "rgb(5,150,105)");
                                $("#validation").text(result.message);
                            }
                        },
                        error: (xhr, status, error) => {
                            const response = JSON.parse(xhr.responseText);
                            if (xhr.status === 409) {
                                $("#validation").css("color", "rgb(244, 63, 94)");
                                $("#validation").text(response.message);
                            } else {
                                $("#validation").css("color", "rgb(244, 63, 94)");
                                $("#validation").text(response.message);
                            }
                        },
                    })
                }

            })

        })
    </script>


</head>

<body>

    <div class=" py-4 shadow-md w-full sticky top-0 bg-white z-30 font-body ">
        <div class="md:max-w-screen-lg m-auto ">
            <div class="md:flex md:items-center md:justify-between px-4">
                <div class="flex items-center justify-between text-lg">
                    <div>
                        <h1 class="font-medium">Logo</h1>
                    </div>
                    <div class="cursor-pointer md:hidden">
                        <i class="fa-solid fa-bars  md:hidden "></i>
                        <i class="fa-solid fa-x" hidden></i>
                    </div>
                </div>
                <div class="mobile-view absolute hidden items-center justify-center -z-10 inset-0 h-screen bg-white md:opacity-0" id="navlist">
                    <ul class="w-full text-center text-xl gap-4 flex flex-col">
                        <li class="">Home</li>
                        <li class="">Home</li>
                        <li class="">Home</li>
                        <li class="">Home</li>
                        <li class="">Home</li>
                    </ul>
                </div>
                <div class="desktop-view">
                    <ul class="hidden gap-6 text-sm font-medium cursor-pointer md:flex">
                        <li class="">Home</li>
                        <li class="">Home</li>
                        <li class="">Home</li>
                        <li class="">Home</li>
                        <li class="">Home</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>


    <section>

        <div class="max-w-screen-xl w-11/12 m-auto h-screen  ">
            <div class="flex flex-col md:flex-row py-20 md:py-40 ">
                <div class="flex-1 md:h-[400px]">
                    <img src="assets/orange2.jpg" class="h-full w-full" alt="image">
                </div>
                <div class="flex-1  p-4 bg-white  border border-gray-300 ">
                    <form id="registration_form" method="post">
                        <div class="flex flex-col gap-4 py-4">
                            <h1 class="text-center">Registration</h1>
                            <div id class="relative w-full focus:caret-indigo-500 overflow-visible   ">
                                <input type="email" name="email" onchange="emailOnchangeLogin()" id="login_email" class="bg-slate-50 border  border-gray-400 text-gray-900 text-sm  w-full p focus:outline-none focus:border-b-slate-600/75 peer  ">
                                <label for="login_email" onfocusout="focusLoginEmail()" id="login_label_email" class="text-xs absolute  left-4 top-2.5  cursor-text  bg-gray-50 rounded-lg   transition-all  peer-focus:text-sm ">Email</label>
                            </div>
                            <div id class="relative w-full focus:caret-indigo-500 overflow-visible   ">
                                <input type="password" name="password" onchange="passwordonChangeLogin()" id="login_password" class="bg-gray-50 border  border-gray-400 text-gray-900 text-sm  w-full p-2 focus:outline-none focus:border-b-slate-600/75 peer  ">
                                <label for="login_password" onchange="focusPasswordEmail()" id="login_label_password" class="text-xs absolute  left-4 top-2.5  cursor-text  bg-gray-50 rounded-lg   transition-all  peer-focus:text-sm ">Password</label>
                            </div>
                            <div id class="relative w-full focus:caret-indigo-500 overflow-visible   ">
                                <input type="password" name="confirm_Password" onchange="confirmPasswordonChangeReg()" id="reg_confirmPassword" class="bg-gray-50 border  border-gray-400 text-gray-900 text-sm  w-full p-2 focus:outline-none focus:border-b-slate-600/75 peer">
                                <label for="reg_confirmPassword" onchange="focusConfirmPasswordEmail()" id="reg_label_confirmPassword" class="text-xs absolute  left-4 top-2.5  cursor-text  bg-gray-50 rounded-lg   transition-all  peer-focus:text-sm ">Confirm Password</label>
                            </div>
                            <div class=" ">
                                <span id="validation" class="  text-xs text-rose-500 "></span>
                            </div>

                            <div class="flex gap-4 justify-between">
                                <button id="backbtn" onClick="location.href='http://localhost/web/login.php'" class="w-[150px] h-[30px] border-emerald-600/60 border-2  text-black  uppercase text-xs font-normal">Go Back</button>
                                <button type="submit" id="submit" name="submit" class="w-[150px] h-[30px] bg-emerald-600 text-white uppercase text-xs font-medium">Register</button>
                            </div>

                        </div>
                    </form>
                </div>


            </div>

        </div>
    </section>


</body>






</html>