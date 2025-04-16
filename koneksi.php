<?php

$hostname = "localhost";
$user = "root";
$pass = "root";
$db_name = "laravel_todo";

$conn = mysqli_connect($hostname, $user, $pass, $db_name);

?>



                            <!-- 04. Display Data
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="task-text">Coding</span>
                                <input type="text" class="form-control edit-input" style="display: none;"
                                    value="Coding">
                                <div class="btn-group">
                                    <button class="btn btn-danger btn-sm delete-btn">✕</button>
                                    <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-1" aria-expanded="false">✎</button>
                                </div>
                            </li> -->
                            <!-- 05. Update Data 
                            <li class="list-group-item collapse" id="collapse-1">
                                <form action="" method="POST">
                                    <div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="task"
                                                value="">
                                            <button class="btn btn-outline-primary" type="button">Update</button>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="radio px-2">
                                            <label>
                                                <input type="radio" value="1" name="is_done"> Selesai
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" value="0" name="is_done"> Belum
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </li>     -->