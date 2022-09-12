<!-- Content body -->
<div class="content-body">
    <!-- Content -->
    <div class="content ">

        <div class="page-header">
            <div>
                <h3>Note</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Weekly Test</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body container">
                        <form method="post" action="updatequestions">
                            <p class="h3 text-center mb-4">Multiple Option Questions</p>
                            <label for="">Quiz Code:</label>
                            <input type="number" class="form-control" name="code" value="<?=$prefill['code']?>">
                            <input type="hidden" name="id" value="<?=$prefill['id']?>">
                            <hr>
                            <label for="">Quiz Title:</label>
                            <input type="text" class="form-control" name="title" value="<?=$prefill['title']?>">
                            <hr>
                            <label for="">Quiz Description:</label>
                            <textarea class="form-control" name="description"><?=$prefill['description']?></textarea>
                            <hr>
                            
                            <?php foreach ($noq as $key => $value): ?>
                            <label for="">Question <?=$key+1?>:</label>
                            <div class="row">
                                <div class="col-12 col-md-9 form-group">
                                    <input class="form-control" type="text" name="obj<?=$key+1?>[0]" placeholder="Question..." value="<?=$quest[$key]->$zero?>">
                                </div>
                                <div class="col-12 col-md-3 form-group">
                                    <input class="form-control" type="text" name="obj<?=$key+1?>[5]" placeholder="Answer..." value="<?=$answer[$key]->ans?>">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group col-6">
                                    <label for="Option A">Option A</label>
                                    <input type="text" class="form-control" name="obj<?=$key+1?>[1]" value="<?=$quest[$key]->$one?>">
                                </div>
                                <div class="form-group col-6">
                                    <label for="Option B">Option B</label>
                                    <input type="text" class="form-control" name="obj<?=$key+1?>[2]" value="<?=$quest[$key]->$two?>">
                                </div>
                                <div class="form-group col-6">
                                    <label for="Option C">Option C</label>
                                    <input type="text" class="form-control" name="obj<?=$key+1?>[3]" value="<?=$quest[$key]->$three?>">
                                </div>
                                <div class="form-group col-6">
                                    <label for="Option D">Option D</label>
                                    <input type="text" class="form-control" name="obj<?=$key+1?>[4]" value="<?=$quest[$key]->$four?>">
                                </div>
                            </div>
                            <?php endforeach; ?>
                            
                            <input class="btn btn-primary" type="submit" value="Update">
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-title pt-3 pl-3">Past Quiz List</h3>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach ($quiz as $key => $qu) : ?>
                                <li class="list-group-item"> <a href=""><?=$qu['title']?></a> </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ./ Content -->

    <!-- CKEditor -->
    <script src="vendors/ckeditor5/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'alignment'],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        }
                    ]
                }
            })
    </script>


    <!-- Footer -->
    <footer class="content-footer">
        <div>© 2021 PHF OGUN - <a href="" target="_blank">RayyanTech</a></div>
        <div>
            <!-- <nav class="nav">
                        <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
                        <a href="#" class="nav-link">Change Log</a>
                        <a href="#" class="nav-link">Get Help</a>
                    </nav> -->
        </div>
    </footer>
    <!-- ./ Footer -->
</div>
<!-- ./ Content body -->
</div>
<!-- ./ Content wrapper -->
</div>
<!-- ./ Layout wrapper -->

<!-- Plugin scripts -->
<script src="vendors/bundle.js"></script>

<!-- App scripts -->
<script src="assets/js/app.min.js"></script>
</body>

</html>