<!-- Content body -->
<div class="content-body">
    <!-- Content -->
    <div class="content">
        <div class="page-header d-md-flex justify-content-between">
            <div>
                <h3>Welcome back, PHF Admin</h3>
                <p class="text-muted">
                    This page shows an overview for your account summary.
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Settings</h6>
                <div class="row">
                    <div class="col-md-6">
                        <p>Quiz Access Code Panel</p>
                        <a href="quizinput" class="btn btn-primary btn-large"><?= strtoupper($quizinput ? $quizinput : 'Enable') ?></a>
                    </div>
                    <div class="col-md-6">
                        <p>Send Out Participant(<?= $quizparticipants ?>) Scores</p>
                        <a href="sendscores" class="btn btn-warning btn-large">SEND</a>
                    </div>
                </div>

            </div>
        </div>

        <!-- <div class="card">
            <div class="card-body">
                <h6 class="card-title">Participants & Score List</h6>
                <div class="table-responsive">
                    <table id="recent" class="table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $key => $user) : ?>
                                <tr>
                                    <td><?= $user['email'] ?></td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">View Detail</a>
                                                        <a href="#" class="dropdown-item">Send</a>
                                                        <a href="#" class="dropdown-item">Edit</a>
                                                <a href="#" class="dropdown-item text-danger">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->

        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Score Sheet</h6>
                <form action="getsc" method="post">
                    <div class="form-group">
                        <label for="scoresheet">Quiz Scoresheet</label>
                        <select class="form-control form-control-lg" name="scoresheet" id="scoresheet">
                            <option>Select a quiz</option>
                            <?php foreach ($quiz as $key => $qui): ?>
                            <option value="<?=$qui['id']?>"><?=$qui['code']?> - <?=$qui['title']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Retrieve</button>
                </form>

                <div class="table-responsive">
                    <table id="recent" class="table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Score</th>
                                <th>Sent Mail</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($score as $key => $user) : ?>
                                <tr>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['password'] ?></td>
                                    <td><?= $user['score'] ?></td>
                                    <td><?= $user['sent'] ?></td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <!-- <a href="#" class="dropdown-item">View Detail</a>
                                                        <a href="#" class="dropdown-item">Send</a>
                                                        <a href="#" class="dropdown-item">Edit</a> -->
                                                <a href="#" class="dropdown-item text-danger">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ./ Content -->

    <!-- Footer -->
    <footer class="content-footer">
        <div>
            © 2021 -
            <a href="https://rayyan.com.ng/" target="_blank">RayyanTech</a>
        </div>
    </footer>
    <!-- ./ Footer -->
</div>
<!-- ./ Content body -->
</div>
<!-- ./ Content wrapper -->
</div>
<!-- ./ Layout wrapper -->

<!-- Main scripts -->
<script src="vendors/bundle.js"></script>

<!-- Apex chart -->
<script src="vendors/charts/apex/apexcharts.min.js"></script>

<!-- FormWizard -->
<script src="vendors/form-wizard/jquery.steps.min.js"></script>

<!-- FormWizard -->
<script src="vendors/datepicker/daterangepicker.js"></script>

<!-- DataTable -->
<script src="vendors/dataTable/datatables.min.js"></script>

<!-- Dashboard scripts -->
<script src="assets/js/dashboard.js"></script>

<!-- App scripts -->
<script src="assets/js/app.min.js"></script>
</body>

</html>