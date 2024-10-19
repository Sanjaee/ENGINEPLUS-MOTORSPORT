<div class="breadcrumb">
	<h1>Ganti Password User</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="card-title mb-3"></div>
                <div>

                    <!-- <?php $grup = $this->session->userdata('mygrup');?> -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="username">Usernamse</label>
                                <div class="col-sm-4">
                                <input class="form-control" type="text" name="username" id="username" maxlength="50" value="<?php echo $this->session->userdata('myusername')?>" readonly required/>
                                <input class="form-control" type="hidden" name="scabang" id="scabang" value="<?php echo $this->session->userdata('mycabang')?>" readonly required />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="tanggal">Tanggal</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" name="tanggal" id="tanggal" maxlength="50" value = "<?php echo date("d-m-Y"); ?>" readonly required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="passwordlama">Password Lama</label>
                                <div class="col-sm-5">
                                <input class="form-control" type="password" name="passwordlama" id="passwordlama" maxlength="50" required/>
                                </div>
                            </div>
                        </div>

                        
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="passwordbaru">Password Baru</label>
                                <div class="col-sm-5">
                                <input class="form-control" type="password" name="passwordbaru" id="passwordbaru" maxlength="50" required/>
                                </div>
                            </div>
                        </div>

                        
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="konfirpass">Konfirmasi Password Baru</label>
                                <div class="col-sm-5">
                                <input class="form-control" type="password" name="konfirpass" id="konfirpass" maxlength="50" required/>
                                </div>
                            </div>
                        </div>

                        
                    </div>

                </div>






            </div>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card mb-4">
			<div class="card-body">
				<div class="form-group">
					<button id="new" class="btn  btn-success"><i class="fa fa-retweet"></i>&nbsp; NEW</button>
					<button id="save" class="btn  btn-success"><i class="fa fa-save"></i>&nbsp;SAVE</button>
					<!-- <button id="find" class="btn  btn-success"><i class="fa fa-search"></i>&nbsp;FIND</button> -->
                    <button id="cancel" class="btn  btn-danger"><i class="fa fa-times"></i>&nbsp; CANCEL</button>
				</div>
			</div>
		</div>
	</div>
</div>