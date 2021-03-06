    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0"><?php echo $page_title ?></h5>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- app invoice View Page -->
                <section class="invoice-edit-wrapper">
                    <div class="row">
                        <!-- invoice view page -->
                        <div class="col-xl-9 col-md-8 col-12">
                            <div class="card">
                                <div class="card-content">    
                                    <form role="form" id="frmMark">  
                                        <input type="hidden" name="id" value="<?php if(isset($item)) echo $item->id; else echo '0';?>"/>                              
                                        <div class="card-body pb-0 mx-25">   
                                            <hr>
                                            <!-- invoice address and contact -->
                                            <div class="row invoice-info">
                                                <div class="col-lg-12 col-md-12 mt-25">
                                                    <h6 class="invoice-to">Text</h6>                                                
                                                    <fieldset class="invoice-address form-group">
                                                        <textarea class="form-control" rows="15" placeholder="Text for mark" name="domains"><?php if(isset($item)) echo $item->domains;?></textarea>
                                                        <div class="err-message">*This field is required</div>
                                                    </fieldset>
                                                </div>
                                                <!-- <div class="col-lg-6 col-md-12 mt-25">  
                                                    <h6 class="invoice-to">Upload Domains(txt file)</h6>                                                                                     
                                                    <form action="#" class="dropzone dropzone-area" id="dpz-single-file">
                                                        <div class="dz-message">Drop Files Here To Upload</div>
                                                    </form>
                                                </div> -->
                                            </div>
                                            <hr>                                            
                                            <div class="row invoice-info">
                                                <div class="col-md-3 col-sm-12"> 
												</div>
												<div class="col-md-12 col-sm-12"> 
                                                    <fieldset class="invoice-address form-group">                                                 
                                                        <button class="btn btn-success btn-block btn-save-mark" type="button">
                                                            <i class="bx bx-save"></i>
                                                            <span class="text-nowrap">Calculate</span>
                                                        </button>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-3 col-sm-12"> 
												</div>
                                            </div>
                                        </div> 
                                    </form>                                 
                                </div>
                            </div>
                        </div>                        
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->