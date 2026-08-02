$(function () {

    $('.datatable').DataTable({

        responsive:true,

        autoWidth:false,

        pageLength:10,

        language:{

            search:"Cari :",

            lengthMenu:"Tampilkan _MENU_ data",

            zeroRecords:"Data tidak ditemukan",

            info:"Menampilkan _START_ - _END_ dari _TOTAL_ data",

            paginate:{

                previous:"Sebelumnya",

                next:"Berikutnya"

            }

        }

    });

});