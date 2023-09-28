<?php

require 'config.php';
session_start();

if (isset($_SESSION["id"])) {

    $id = $_SESSION["id"];
    $query = "SELECT * FROM regusers where id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login.php");
    exit();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/01d1b52149.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
    </style>
    <script defer src="main.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(() => {


            $("#register").click(() => {
                $("#validation").css("display", "none");
            })

            $("#create_form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "database/updateUser.php",
                    data: $(this).serialize(),
                    success: (result) => {
                        window.location.href = "index.php";
                    },
                    error: (xhr, status, error) => {
                        // Handle AJAX errors
                        $("#validation").css("color", "rgb(244, 63, 94)");
                        $("#validation").text("AJAX Error: " + error);
                    }
                });
            });


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

        <div class="max-w-screen-lg m-auto py-20   ">
            <h1 class="text-lg font-medium">Edit Profile</h1>
            <div class="p-4">
                <!-- <button class="w-[150px] h-[30px] bg-orange-500 text-white uppercase text-xs font-medium">Add User</button> -->
                <form class="py-20" id="create_form" action="">

                    <?php

                    require 'config.php';
                    $id = $_GET['id'];
                    $query = "SELECT * from users where id = '$id'";
                    $result = mysqli_query($conn, $query);

                    $rows = mysqli_fetch_assoc($result);


                    ?>
                    <div class="pb-4">
                        <span id="validation" class="  text-xs text-rose-500 "></span>
                    </div>
                    <div class="grid gap-4  grid-cols-2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div id class="relative w-full focus:caret-indigo-500 overflow-visible   ">
                            <input type="text" value="<?php echo $rows['firstname']  ?>" name="firstname" id="firstname" onchange="firstnameOnchange()" class="bg-gray-50 border  border-gray-400 text-gray-900 text-sm  w-full p-2 focus:outline-none focus:border-b-slate-600/75 peer  ">
                            <label for="firstname" id="label_firstname" class="text-xs absolute peer left-4 top-2.5  cursor-text  bg-gray-50 rounded-lg   transition-all  peer-focus:text-sm ">First Name</label>
                        </div>


                        <div id class="relative w-full focus:caret-indigo-500   ">
                            <input type="text" value="<?php echo $rows['lastname'] ?>" name="lastname" id="lastname" onchange="lastnameonChange()" class="bg-gray-50 border   border-gray-400 text-gray-900 text-sm  w-full p-2 focus:outline-none focus:border-b-slate-600/75 peer">
                            <label for="lastname" id="label_lastname" class="text-xs absolute peer left-4 top-2.5  cursor-text bg-gray-50   transition-all  peer-focus:text-sm ">Last Name</label>
                        </div>

                    </div>
                    <div class="flex flex-col gap-4 pt-4">
                        <div id class="relative  focus:caret-indigo-500  ">
                            <input type="text" value="<?php echo $rows['email']  ?>" name="email" id="email" onchange="emailOnchange() " class="bg-gray-50 border border-gray-400 text-gray-900 text-sm  w-full md:w-[49.194%] p-2 focus:outline-none focus:border-b-slate-600/75 peer">
                            <label for="email" id="label_email" class="text-xs absolute peer left-4 top-2.5  cursor-text  bg-gray-50 transition-all  peer-focus:text-sm ">Email</label>
                        </div>
                        <div id class="relative  focus:caret-indigo-500  ">
                            <input type="text" value="<?php echo $rows['age']  ?>" name="age" id="age" onchange="ageOnchange() " class="bg-gray-50 border border-gray-400 text-gray-900 text-sm  w-full md:w-[49.194%] p-2 focus:outline-none focus:border-b-slate-600/75 peer">
                            <label for="age" id="label_age" class="text-xs absolute peer left-4 top-2.5  cursor-text  bg-gray-50 transition-all  peer-focus:text-sm ">Age</label>
                        </div>

                        <div class="pt-8 flex items-center text-sm">
                            <label class="text-sm">Gender:</label>
                            <div class="px-4 flex items-center gap-4">
                                <label for="male" class="flex items-center gap-2">
                                    <input id="male" type="radio" name="gender" value="Male" <? echo ($rows['gender'] === 'Male' ? "checked" : " ") ?>>
                                    <span class="text-gray-700">Male</span>
                                </label>
                                <label for="female" class="flex items-center gap-2">
                                    <input id="female" type="radio" name="gender" value="Female" <? echo ($rows['gender'] === 'Male' ? "checked" : "") ?>>
                                    <span class="text-gray-700">Female</span>
                                </label>
                            </div>

                        </div>


                        <div class="pt-6">
                            <button name="submit" class="w-[150px] h-[30px] bg-orange-500 text-white uppercase text-xs font-medium">EDIT</button>
                            <button onClick="location.href='http://localhost/web/index.php'" class="w-[150px] h-[30px] bg-rose-500 text-white uppercase text-xs font-medium">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


</body>






</html>