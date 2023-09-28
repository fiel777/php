<?php
session_start();
require 'config.php';


if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    header("Location: index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/01d1b52149.js" crossorigin="anonymous"></script>
    <script src="login.js" type="text/javascript" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(() => {

            $("#register").click(() => {
                $("#validation").css("display", "none");
            })

            $("#login_form").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    data: $(this).serialize(),
                    url: "database/loginUser.php",
                    success: (result, status, xhr) => {
                        if (xhr.status === 200 && result.status === "success") {
                            console.log(result);

                            // $("#validation").css("color", "rgb(5,150,105)");
                            // $("#validation").text(result.message);
                            window.location.href = "index.php";

                        } else {
                            $("#validation").css("color", "rgb(244, 63, 94)");
                            $("#validation").text(result.message);
                        }
                    },

                    error: (xhr, status, error) => {
                        const response = JSON.parse(xhr.responseText);

                        if (response.status === "User not found" && xhr.status === 400) {
                            $("#validation").css("color", "rgb(244, 63, 94)");
                            $("#validation").text(response.message);
                        } else {
                            $("#validation").css("color", "rgb(244, 63, 94)");
                            $("#validation").text(response.message);
                        }

                    }

                });


            });

        });
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
                    <img src="assets/orange.jpg" class="h-full w-full" alt="image">
                </div>
                <div class="flex-1  p-4  border border-gray-300 ">
                    <form id="login_form" method="post" action="database/loginUser.php">
                        <div class="flex flex-col gap-4 py-4">
                            <h1 class="text-center ">Login</h1>
                            <div id class="relative w-full focus:caret-indigo-500 cursor-text  ">
                                <input type="email" name="email" onchange="emailOnchangeLogin()" id="login_email" class=" bg-white border border-gray-400 text-gray-900 text-sm w-full p-2 focus:outline-none focus:border-b-slate-600/75 peer">
                                <label for="login_email" id="login_label_email" class="text-xs absolute  left-4 top-2.5  cursor-text  bg-gray-50 rounded-lg transition-all peer-focus:text-sm" onclick="focusLoginEmail()">Email</label>
                            </div>
                            <div id class="relative w-full focus:caret-indigo-500   ">
                                <input type="password" name="password" onchange="passwordonChangeLogin()" id="login_password" class="bg-gray-50 border  border-gray-400 text-gray-900 text-sm  w-full p-2 focus:outline-none focus:border-b-slate-600/75 peer  ">
                                <label for="login_password" id="login_label_password" class="text-xs absolute  left-4 top-2.5  cursor-text bg-gray-50 rounded-lg  transition-all  peer-focus:text-sm " onclick="focusPasswordEmail()">Password</label>
                            </div>
                            <div class=" ">
                                <span id="validation" class="  text-xs text-rose-500 "></span>
                            </div>
                            <div class="flex gap-4">
                                <button name="submit" class="w-[150px] h-[30px] bg-emerald-600 text-white outline-none border-none uppercase text-xs font-medium hover:scale-105 transition ">Login</button>
                                <button id="register" onClick="location.href='http://localhost/web/register.php'" class="w-[150px] outline-none border-none h-[30px] bg-emerald-600 text-white uppercase text-xs font-medium  hover:scale-105 transition">Register</button>
                            </div>

                        </div>
                    </form>


                </div>
            </div>

        </div>
    </section>


</body>






</html>