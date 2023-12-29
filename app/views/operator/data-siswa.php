<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftar</title>
    <style>
    /* Your existing styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    h2 {
        color: #007BFF;
        margin-bottom: 20px;
    }

    a {
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        margin-bottom: 20px;
        display: inline-block;
        background-color: #007BFF;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
    }

    a:hover {
        background-color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
        overflow-x: auto;
        /* Enable horizontal scrolling */
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #007BFF;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    p {
        margin-top: 20px;
        color: #333;
    }

    button {
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #c82333;
    }

    /* Pagination styles */
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 20px 0;
    }

    .pagination li {
        margin-right: 10px;
    }

    .pagination a {
        text-decoration: none;
        background-color: #007BFF;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        margin: 0 10px;
        /* Added margin */
    }

    .pagination a:hover {
        background-color: #0056b3;
    }

    .btnpdf {
        margin: 10px 0px;
        background-color: green;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btndlt {
        margin: 10px 0px;
        background-color: #dc3545;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .tablecenter {
        alignment: 'center';
    }

    @media print {
        table {
            width: 100% !important;
        }
    }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
</head>

<body>
    <center>
        <h2><?= $data['title'] ?></h2>
        <a href="<?= BASEURL ?>/operator/form-simpan"> + Tambah Data</a>
    </center>

    <form method="post" action="">
        <button type="submit" name="delete_selected" class="btndlt">Delete Selected</button>
        <br>
        <table id="tblFeStaging" border="1" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th><input type="checkbox" id="select_all"> Select All</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Sekolah Asal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($data['dataSiswa'] as $sw) {
                ?>
                <tr>
                    <td class="align-middle text-center"><?php echo $no; ?></td>
                    <td><input type="checkbox" name="selected_ids[]" value="<?php echo $sw['id']; ?>"></td>
                    <td><?php echo $sw['nama']; ?></td>
                    <td><?php echo $sw['alamat']; ?></td>
                    <td><?php echo $sw['jenis_kelamin']; ?></td>
                    <td><?php echo $sw['nama_agama']; ?></td>
                    <td><?php echo $sw['sekolah_asal']; ?></td>
                    <td class="align-middle">
                        <a href="<?= BASEURL ?>/operator/form-ubah/<?= $sw['id'] ?>">Ubah</a><br>
                        <a href="<?= BASEURL ?>/operator/deletesiswa/<?= $sw['id'] ?>"
                            onclick="return confirm('yakin ?')">Hapus</a>
                    </td>
                </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->

        <p>Jumlah data : <?= $data['totalDatasiswa'] ?></p>
    </form>
    <p><a href="<?= BASEURL ?>/operator/">kembali</a></p>

    <!-- JavaScript for select all checkbox -->
    <script>
    document.getElementById('select_all').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = !checkbox.checked;
        });
    });
    </script>

    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css" rel="stylesheet"
        type="text/css" />

    <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.jqueryui.min.js" type="text/javascript"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js" type="text/javascript"></script>
    <style>
    div.dt-buttons {
        position: relative;
        float: right !important;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function() {
        var logo;
        // Function to convert an img URL to data URL
        function getBase64FromImageUrl(url) {
            var img = new Image();
            img.crossOrigin = "anonymous";
            img.onload = function() {
                var canvas = document.createElement("canvas");
                canvas.width = this.width;
                canvas.height = this.height;
                var ctx = canvas.getContext("2d");
                ctx.drawImage(this, 0, 0);
                var dataURL = canvas.toDataURL("image/png");
                return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
            };
            img.src = url;
        }
        logo = getBase64FromImageUrl(
            'http://4.bp.blogspot.com/-lReYLgBjpR8/WKA_TG2J4XI/AAAAAAAAAQU/v67E2s4BmtIeyelnP7skweDqP7nui2TrQCK4B/s752/ReddyInfoSoft%2BIcon%2B128%2BTransparent.png'
        );
        //logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
        //logo = getBase64FromImageUrl('./datatables.png');
        //logo = getBase64FromImageUrl('./ReddyInfoSoft.png');
        $('#tblFeStaging').DataTable({
            "ordering": false,
            "pageLength": 25,
            dom: 'Blrtip',
            buttons: [{
                extend: 'pdfHtml5',
                title: "Main Title",
                pageSize: 'A4',
                exportOptions: {
                    search: 'applied',
                    order: 'applied',
                    stripNewlines: false
                },
                customize: function(doc) {
                    var rdoc = doc;
                    var rcout = doc.content[doc.content.length - 1].table.body.length - 1;
                    doc.content.splice(0, 1);
                    var now = new Date();
                    var jsDate = now.getDate() + '/' + (now.getMonth() + 1) + '/' + now
                        .getFullYear() + '  and Time:' + now.getHours() + ':' + now
                        .getMinutes() + ':' + now.getSeconds();
                    doc.pageMargins = [30, 90, 30, 30];
                    doc.defaultStyle.fontSize = 8;
                    doc.styles.tableHeader.fontSize = 9;
                    doc.content[doc.content.length - 1].table.headerRows = 2;
                    for (var i = 0; i < rcout; i++) {
                        var obj = doc.content[doc.content.length - 1].table.body[i + 1];
                        doc.content[doc.content.length - 1].table.body[(i + 1)][0] = {
                            text: obj[0].text,
                            style: [obj[0].style],
                            bold: true
                        };
                        doc.content[doc.content.length - 1].table.body[(i + 1)][3] = {
                            text: obj[3].text,
                            style: [obj[3].style],
                            alignment: 'center',
                            bold: obj[3].text > 60 ? true : false,
                            fillColor: obj[3].text > 60 ? 'red' : null
                        };

                    }

                    doc['header'] = (function(page, pages) {
                        return {
                            table: {
                                //widths: ['100%'],
                                widths: ['auto', 'auto'],
                                headerRows: 0,
                                body: [
                                    [{
                                            //margin: [0, 10, 0, 0],
                                            width: 38, //'auto',
                                            alignment: 'center',
                                            /*ReddyInfoSoft*/
                                            //image: 'data:image/png;base64,' + logo,
                                            image: 'data:image/png;base64,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',
                                            //image: './ReddyInfoSoft.png'
                                        },
                                        {
                                            text: 'Sample Main Title',
                                            alignment: 'center',
                                            fontSize: 14,
                                            bold: true,
                                            width: 'auto'
                                            //, margin: [0, 10, 0, 0]
                                        }
                                    ],
                                    [{
                                        text: [{
                                                text: 'SubTitle1: ',
                                                bold: true
                                            },
                                            'Sub title details...1\n',
                                            {
                                                text: 'SubTitle2: ',
                                                bold: true
                                            }, 'Sub title details...2',
                                        ]
                                    }, {}]
                                ]
                            },
                            layout: 'noBorders',
                            margin: 10
                        }
                    });

                    doc['footer'] = (function(page, pages) {
                        return {
                            columns: [{
                                    alignment: 'left',
                                    text: ['Created Date: ', {
                                        text: jsDate.toString()
                                    }]
                                },
                                {
                                    alignment: 'center',
                                    text: 'Total ' + rcout.toString() + ' rows'
                                },
                                {
                                    alignment: 'right',
                                    text: ['page ', {
                                        text: page.toString()
                                    }, ' of ', {
                                        text: pages.toString()
                                    }]
                                }
                            ],
                            margin: 10
                        }
                    });

                    var objLayout = {};
                    objLayout['hLineWidth'] = function(i) {
                        return .8;
                    };
                    objLayout['vLineWidth'] = function(i) {
                        return .5;
                    };
                    objLayout['hLineColor'] = function(i) {
                        return '#aaa';
                    };
                    objLayout['vLineColor'] = function(i) {
                        return '#aaa';
                    };
                    objLayout['paddingLeft'] = function(i) {
                        return 5;
                    };
                    objLayout['paddingRight'] = function(i) {
                        return 35;
                    };
                    doc.content[doc.content.length - 1].layout = objLayout;

                }
            }]
        });
    });
    </script>

</body>

</html>