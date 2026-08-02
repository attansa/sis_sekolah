<?php

require_once __DIR__ . '/../models/Kinerja.php';

class KinerjaController
{
    private $kinerja;

    public function __construct()
    {
        $this->kinerja = new Kinerja();
    }

    // =====================================
    // Halaman Kinerja
    // =====================================
    public function index()
    {

        // Guru
        if(userRole() == 'guru'){

            return [

                'total'    => $this->kinerja->totalNilai($_SESSION['id']),
                'progress' => $this->kinerja->progress($_SESSION['id'])

            ];

        }

        // Staff
        if(userRole() == 'staff'){

            return [

                'data' => $this->kinerja->user($_SESSION['id'])

            ];

        }

        // Kepsek & Super Admin
        return [

            'data' => $this->kinerja->all()

        ];

    }

    // =====================================
    // Dashboard Kepala Sekolah
    // =====================================
    public function dashboardKepsek()
    {
        return [

            'guru'      => $this->kinerja->totalGuru(),

            'upload'    => $this->kinerja->guruUploadEvidence(),

            'pending'   => $this->kinerja->evidencePending(),

            'approve'   => $this->kinerja->evidenceApprove(),

            'ranking'   => $this->kinerja->topGuru()

        ];
    }

}