    <div class="container">
        <div class="card mx-2 my-4">
            <div class="card-header">
                <h5>Upload Excel File</h5>
            </div>
            <form action="./upload" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Excel File</label>
                                <input type="file" class="form-control-file" name="xlsx">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Upload">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>