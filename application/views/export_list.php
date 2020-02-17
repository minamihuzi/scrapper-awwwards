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
                    <a href="<?php echo site_url('export/add')?>" class="btn btn-primary glow invoice-create" role="button" aria-pressed="true">New Project</a>
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
									<th>Count</th>									
                                    <th>Run</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$page = explode('_', $page_code);
                                if(!empty($list)){
                                    foreach($list as $item) {
                                        $id=$item->id;
                                        $download_file="./app-assets/download_files/export".$id.".csv";
                                        if(file_exists($download_file)){
                                            $status="badge-light-success";
                                            $state="Checked";
                                        }
                                        else {
                                            $status="badge-light-danger";
                                            $state="Unchecked";
                                        }
                                        $domains=array_filter(explode("\n", $item->domains));
                                        $domain_count=count($domains);
                                        $domains=implode("\n", $domains);
                                        echo '<tr>
                                                <td class="domain_info" domains="'.$domains.'" email="'.$item->username.'" password="'.$item->password.'"></td>
                                                <td data-id="'.$item->id.'"></td>
                                                <td><a href="'.base_url($page[0].'/edit/'.$item->id).'">'.$item->name.'</a></td>
                                                <td><span class="invoice-amount">'.$item->s_date.'</span></td>
                                                <td><small class="text-muted">'.$domain_count.'</small></td>
                                                ';
                                        echo '<td>
                                                <span class="invoice-customer">                                                   
                                                    <a href="javascript:;" class="multi_down cursor-pointer" data-val="'.$item->id.'">
                                                        <i class="bx bx-send"></i>
                                                        Run
                                                    </a>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="invoice-action">
                                                    
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