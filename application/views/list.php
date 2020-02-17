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
                <!-- invoice list -->
                <section class="invoice-list-wrapper">
                    <!-- create invoice button-->
                    <div class="invoice-create-btn mb-1">
                        <a href="<?php echo base_url('analysis/proxy_test')?>" target="blank" class="btn btn-warning glow invoice-create" role="button" aria-pressed="true">Proxy Test</a>
                    </div>
                    <!-- Options and filter dropdown button-->
                    <div class="action-dropdown-btn d-none">                        
                        <div class="dropdown invoice-options">
                            <button class="btn border dropdown-toggle mr-2" type="button" id="invoice-options-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Options
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="invoice-options-btn">
                                <a class="dropdown-item btn-batch-run" href="javascript:">Submit</a>
                                <a class="dropdown-item btn-batch-delete" href="javascript:">Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table invoice-data-table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Project ID</th>
                                    <th>Project Name</th>
                                    <th>Date Submitted</th>
                                    <th># of Domains Submitted</th>
                                    <!-- <th>Username</th>
                                    <th>Password</th> -->
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$page = explode('_', $page_code);
                                if(!empty($list)){
                                    foreach($list as $item) {
                                        echo '<tr>
                                                <td></td>
                                                <td data-id="'.$item->id.'"></td>
                                                <td><a href="'.base_url($page[0].'/edit/'.$item->id).'">'.$item->name.'</a></td>
                                                <td><span class="invoice-amount">'.$item->s_date.'</span></td>
                                                <td><small class="text-muted">'.$item->count_of_domains.'</small></td>';
                                                // <td><span class="invoice-customer">'.$item->username.'</span></td>
                                                // <td><span class="invoice-customer">'.$item->password.'</span></td>';
                                        if($item->status==0)
                                            echo '<td class="status"><span class="badge badge-light-danger badge-pill">WAITING</span></td>';
                                        else
                                            echo '<td class="status"><span class="badge badge-light-success badge-pill">SUBMITTED</span></td>';
                                        echo '<td>
                                                <div class="invoice-action">
                                                    <a href="javascript:" class="invoice-action-view mr-1 btn-run-item" title="Run Project" data-id="'.$item->id.'">
                                                        <i class="bx bx-paper-plane"></i>
                                                    </a>
                                                    <a href="javascript:" class="invoice-action-edit cursor-pointer btn-delete-item" title="Delete Project" data-id="'.$item->id.'">
                                                        <i class="bx bx-trash-alt"></i>
                                                    </a>
                                                </div>
                                                </td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->