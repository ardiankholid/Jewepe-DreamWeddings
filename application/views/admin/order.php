<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Order</h3>
                    <h6 class="font-weight-normal mb-0">Jewepe Dream Weddings</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="card-title">Data Pesanan Paket Pernikahan</h4>
                        </div>
                        <div class="col-lg-12">
                            <?= $this->session->flashdata('message');
                            ; ?>
                        </div>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Gambar</th>
                                    <th class="text-center">Nama Paket</th>
                                    <th class="text-center">Nama Pemesan</th>
                                    <th class="text-center">Email Pemesan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($getAllOrdered as $row):
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no++; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('assets/files/catalog/') . $row->image; ?>"
                                                target="_blank">
                                                <img src="<?= base_url('assets/files/catalog/') . $row->image; ?>"
                                                    class="img_fluid" style="border-radius:10%; width:60px; height:60px;"
                                                    alt=""></a>
                                        </td>
                                        <td>
                                            <?= $row->package_name; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $row->name; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $row->email; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if ($row->status == 'Requested') {
                                                echo '<div class="badge badge-primary">Menunggu Konfirmasi</div>';
                                            } elseif ($row->status == 'Rejected') {
                                                echo '<div class="badge badge-danger">Pesanan Ditolak</div>';
                                            } else {
                                                echo '<div class="badge badge-success">Pesanan Diterima</div>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($row->status == 'Requested') { ?>
                                                <a class="btn btn-sm btn-info"
                                                    href="<?= base_url('admin/Order/updateStatus?status=approved&id=') . $row->order_id ?>"
                                                    title="Terima">Terima</a>
                                                <a class="btn btn-sm btn-danger"
                                                    href="<?= base_url('admin/Order/updateStatus?status=rejected&id=') . $row->order_id ?>"
                                                    title="Tolak"
                                                    onclick="return confirm('Apakah anda yakin akan menolak pesanan ini?')">Tolak</a>
                                            <?php } else { ?>
                                                <a class="btn btn-sm btn-warning"
                                                    href="<?= base_url('admin/Order/updateStatus?status=requested&id=') . $row->order_id ?>"
                                                    title="Batalkan">Batalkan</a>
                                            <?php } ?>
                                            <a class="btn btn-sm btn-danger"
                                                href="<?= base_url('admin/Order/delete?id=') . $row->order_id ?>"
                                                title="Hapus"
                                                onclick="return confirm('Apakah anda yakin akan menghapus pesanan ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>