<style>
    /* a.paginate_button {
        padding: 0px 10px 0px 10px !important;
        border: 2px solid !important;
        border-radius: 10px !important;
    } */
    .dataTables_filter label {
        position: relative;
        top: -30px;
    }

    a.paginate_button.current {
        padding: 0px 10px 0px 10px !important;
        border: 2px solid !important;
        border-radius: 10px !important;
        margin-right: 10px !important;
        margin-left: 10px !important;
        cursor: pointer !important;
    }

    a.paginate_button {
        cursor: pointer !important;
    }

    a#common_datatable_cms_next {
        padding: 10px !important;
        cursor: pointer;
    }

    a#common_datatable_cms_previous {
        padding: 10px !important;
        cursor: pointer;
    }


    #message_div {
        background-color: #ffffff;
        border: 1px solid;
        box-shadow: 10px 10px 5px #888888;
        display: none;
        height: auto;
        left: 36%;
        position: fixed;
        top: 20%;
        width: 40%;
        z-index: 1;
    }

    #close_button {
        right: -15px;
        top: -15px;
        cursor: pointer;
        position: absolute;
    }

    #close_button img {
        width: 30px;
        height: 30px;
    }

    #message_container {
        height: 450px;
        overflow-y: scroll;
        padding: 20px;
        text-align: justify;
        width: 99%;
    }

    .dataTables_wrapper>div {
        background-color: #f2ebed important;
    }
</style>
<!-- start patient -->

<!-- start patient -->

<div id="page-content">
    <ul class="breadcrumb breadcrumb-top">
        <li>
            <a href="<?php echo site_url('pwfpanel'); ?>">Home</a>
        </li>
        <li>
            <a href="<?php echo site_url('tutorials'); ?>">Tutorials</a>
        </li>
    </ul>

    <div class="block full">
        <div class="block-title">
            <h2><strong><?php echo $title; ?></strong> Panel</h2>

            <h2> <a href="javascript:void(0)" onclick="open_modal('index.php/tutorials/open_model')" class="<?php echo THEME_BUTTON; ?>">
                    Tutorials
                    <i class="fa fa-plus"></i>
                </a>
                </a></h2>

                <h2>
                <a href="javascript:void(0)" onclick="open_category_modal('index.php/tutorials')" class="<?php echo THEME_BUTTON; ?>">
                    Category
                    <i class="fa fa-plus"></i>
                </a>
            </h2>
        </div>
        <div class="table-responsive">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="row">
                                <?php $message = $this->session->flashdata('success');
                                if (!empty($message)) :
                                ?><div class="alert alert-success">
                                        <?php echo $message; ?></div><?php endif; ?>
                                <?php $error = $this->session->flashdata('error');
                                if (!empty($error)) :
                                ?><div class="alert alert-danger">
                                        <?php echo $error; ?></div><?php endif; ?>
                                <div id="message"></div>
                                <div class="col-lg-12" style="overflow-x: auto">
                                    <table class="table table-bordered table-responsive" id="common_datatable_cms">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('serial_no'); ?></th>
                                                <th>Category</th>
                                                <th>Tutorial</th>
                                                <th>Description</th>
                                                <th>File</th>
                                                <th><?php echo lang('action'); ?></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if (isset($list) && !empty($list)) :
                                                $rowCount = 0;
                                                foreach ($list as $rows) :
                                                    $rowCount++;
                                            ?>
                                                    <tr>
                                                        <td><?php echo $rowCount; ?></td>
                                                        <td><?php echo $rows->category_name; ?></td>
                                                        <td><?php echo $rows->tutorial; ?></td>
                                                        <td><?php echo $rows->description; ?></td>
                                                        <td>
                                                            <a class="btn btn-primary" href="<?php echo base_url() . 'index.php/tutorials/show?tutorial_id=' . ($rows->id); ?>" data-toggle="tooltip" class="btn btn-default"></i>View Attachments</a>
                                                        </td>
                                                        <td class="actions">
                                                            <a href="javascript:void(0)" class="btn btn-xs btn-default" onclick="editFn('index.php/tutorials', 'tutorial_edit', '<?php echo encoding($rows->id) ?>');"><i class="fa fa-pencil"></i></a>
                                                            <a href="javascript:void(0)" onclick="deleteFn('<?php echo 'tutorial'; ?>', 'id', '<?php echo encoding($rows->id); ?>', 'index.php/tutorials', '', 'tutorial')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php endforeach;
                                            endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="form-modal-box"></div>
                    </div>
                </div>
            </div>
            <div id="message_div">
                <span id="close_button"><img src="<?php echo base_url(); ?>backend_asset/images/close.png" onclick="close_message();"></span>
                <div id="message_container"></div>
            </div>
        </div>
    </div>
</div>