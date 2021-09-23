    <div class="container">
        <div class="card mx-2 my-4">
            <form action="/upload" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="form-group">
                                <label for="input-xlsx">Upload Excel (.xlsx) File</label>
                                <input type="file" class="form-control-file" id="input-xlsx" name="xlsx">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
