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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
    </style>

</head>

<body>
    <div class=" py-4 shadow-md w-full sticky top-0 bg-white z-30 font-body ">
        <div class="md:max-w-screen-2xl m-auto ">
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
                    <!-- <ul class="hidden gap-6 text-sm font-medium cursor-pointer md:flex">
                        <li class="">Home</li>
                        <li class="">Home</li>
                        <li class="">Home</li>
                        <li class="">Home</li>
                        <li class="">Home</li>
                    </ul> -->
                    <div class="flex items-center text-sm gap-20">
                        <div class="flex items-center gap-2">
                            <h1 class="text-xs font-medium">Email:</h1> <?php echo $row['email'] ?>
                        </div>
                        <a href="logout.php" class="text-normal font-semibold">Logout</a>
                    </div>


                </div>
            </div>

        </div>

    </div>

    <div class="md:max-w-screen-2xl m-auto">
        <div class="py-20 flex  items-center">
            <button onClick="location.href = 'http://localhost/web/create.php'" class="w-[150px] h-[30px] bg-orange-500 text-white uppercase text-xs font-medium">ADD</button>
            <div class="flex w-full justify-end gap-4">
                <form method="POST" class="flex gap-4" id="searchForm">
                    <input type="text" id="search" class="border-2 border-gray-400 focus:outline-none w-[100%] px-4">
                </form>
            </div>
        </div>
    </div>


    <div class="flex flex-col ">
        <div class="overflow-auto h-[500px]">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8 overflow-y  ">
                <div class="overflow-hidden ">
                    <table class=" min-w-full text-left text-sm bg-slate-50 border   ">
                        <thead class="border-b font-medium ">
                            <tr>
                                <th scope="col" class="px-8 py-4 font-medium text-normal">#</th>
                                <th scope="col" class="px-8 py-4 font-medium text-normal">First Name</th>
                                <th scope="col" class="px-8 py-4 font-medium text-normal">Last Name</th>
                                <th scope="col" class="px-8 py-4 font-medium text-normal">Age</th>
                                <th scope="col" class="px-8 py-4 font-medium text-normal">Email</th>
                                <th scope="col" class="px-8 py-4 font-medium text-normal">Gender</th>
                                <th scope="col" class="px-8 py-4 font-medium text-normal">Date Created</th>
                                <th scope="col" class="px-16 py-4 font-medium text-normal">Handle</th>
                            </tr>
                        </thead>
                        <tbody id="userTable">
                            <?php
                            require 'config.php';
                            $query = "SELECT * FROM users ";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-100   dark:hover:bg-slate-400 dark:hover:text-white ">
                                    <td class="whitespace-nowrap px-8 py-4 "><?php echo $row['id'] ?></td>
                                    <td class="whitespace-nowrap px-8 py-4"><?php echo $row['firstname'] ?></td>
                                    <td class="whitespace-nowrap px-8 py-4"><?php echo $row['lastname'] ?></td>
                                    <td class="whitespace-nowrap px-8 py-4"><?php echo $row['age'] ?></td>
                                    <td class="whitespace-nowrap px-8 py-4"><?php echo $row['email'] ?></td>
                                    <td class="whitespace-nowrap px-8 py-4"><?php echo $row['gender'] ?></td>
                                    <td class="whitespace-nowrap px-8 py-4"><?php echo $row['date'] ?></td>
                                    <td class="whitespace-nowrap px-8 py-4">
                                        <div class="cursor-pointer flex gap-2 justify-start pl-4text-sm  ">
                                            <span class="px-4 py-2 bg-emerald-500 text-white cursor-pointer" onclick="location.href='edit.php?id=<?php echo $row['id']; ?>'">EDIT</span>
                                            <button class="px-4 py-2 bg-rose-500 text-white cursor-pointer delete-button" data-id="<?php echo $row['id'] ?>">DELETE</button>
                                        </div>
                                    </td>
                                <?php

                            }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

                $('#search').keyup(function() {
                    var input = $(this).val();

                    if (input != "") {
                        $.ajax({
                            url: "database/searchUser.php",
                            method: "POST",
                            data: {
                                search: input    
                            },
                            success: (result) => {

                                var updatedRows = result.map(user => `
                                    <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:hover:bg-slate-400 dark:hover:text-white">
                                    <td class="whitespace-nowrap px-8 py-4">${user.id}</td>
                                    <td class="whitespace-nowrap px-8 py-4">${user.firstname}</td>
                                    <td class="whitespace-nowrap px-8 py-4">${user.lastname}</td>
                                    <td class="whitespace-nowrap px-8 py-4">${user.age}</td>
                                    <td class="whitespace-nowrap px-8 py-4">${user.email}</td>
                                    <td class="whitespace-nowrap px-8 py-4">${user.gender}</td>
                                    <td class="whitespace-nowrap px-8 py-4">${user.date}</td>
                                    <td class="whitespace-nowrap px-8 py-4">
                                        <div class="cursor-pointer flex gap-2 justify-start pl-4text-sm  ">
                                      <span class="px-4 py-2 bg-emerald-500 text-white cursor-pointer" onclick="location.href='edit.php?id=${user.id}'">EDIT</span>
                                            <button class="px-4 py-2 bg-rose-500 text-white cursor-pointer delete-button" data-id="${user.id}">DELETE</button>
                                        </div>
                                    </td>
                                </tr> `);
                                $('#userTable').html(updatedRows);

                            },
                            error: (xhr, status, error) => {
                                console.error("AJAX Error:", error);
                            }
                        });
                    } else {

                        updateUserList();
                    }
                });

                $(document).on('click', '.delete-button', function() {
                    const userId = $(this).data('id');
                    deleteUser(userId);
                    console.log('Delete button clicked for user ID:', userId);
                });


                function deleteUser(userID) {
                    $.ajax({
                        type: 'GET',
                        url: 'database/deleteUser.php',
                        dataType: 'json',
                        data: {
                            id: userID
                        },
                        success: function(result) {
                            if (result.status === 'success') {
                                updateUserList();

                            } else {
                                console.error('Failed to delete user:', result.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', error);
                        }
                    });

                }

            }

        );

        function updateUserList() {
            $.ajax({
                type: 'GET',
                url: 'database/fetchUser.php',
                dataType: 'json',
                success: function(result) {
                    var updatedRows = result.map(user => `
                            <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:hover:bg-slate-400 dark:hover:text-white">
                                <td class="whitespace-nowrap px-8 py-4">${user.id}</td>
                                <td class="whitespace-nowrap px-8 py-4">${user.firstname}</td>
                                <td class="whitespace-nowrap px-8 py-4">${user.lastname}</td>
                                <td class="whitespace-nowrap px-8 py-4">${user.age}</td>
                                <td class="whitespace-nowrap px-8 py-4">${user.email}</td>
                                <td class="whitespace-nowrap px-8 py-4">${user.gender}</td>
                                <td class="whitespace-nowrap px-8 py-4">${user.date}</td>
                                <td class="whitespace-nowrap px-8 py-4">
                                    <div class="cursor-pointer flex gap-2 justify-start pl-4text-sm">
                                        <span class="px-4 py-2 bg-emerald-500 text-white cursor-pointer" onclick="location.href='edit.php?id=${user.id}'">EDIT</span>
                                        <button class="px-4 py-2 bg-rose-500 text-white cursor-pointer delete-button" data-id="${user.id}">DELETE</button>
                                    </div>
                                </td>
                            </tr>
                        `);

                    $('#userTable').html(updatedRows);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }
    </script>

    </div>




</body>


</html>