<?php

return [
    'letter' => [
        'nomor_agenda' => 'Agenda Number',
        'from' => 'Sender',
        'to' => 'Receiver',
        'nomor_dokument' => 'Reference Number',
        'tgl_dokument' => 'Letter Date',
        'tgl_diterima' => 'Received Date',
        'description' => 'Brief Contents',
        'note' => 'Note',
        'dispose' => 'Dispose',
        'attachment' => 'Attachment',
        'status' => [
            'all' => 'All',
            'disposed' => 'Disposed',
            'not_disposed' => 'Not Disposed',
        ],
        'klasifikasi_kode' => 'Classification Code',
    ],
    'disposition' => [
        'to' => 'Receiver',
        'content' => 'Content',
        'status' => 'Status',
        'note' => 'Note',
        'batas_waktu' => 'Due Date',
        'notice_me' => 'Disposition letter for :nomor_dokument.',
    ],
    'classification' => [
        'code' => 'Code',
        'type' => 'Type',
        'description' => 'Description',
    ],
    'status' => [
        'status' => 'Status',
    ],
    'user' => [
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'phone' => 'Phone',
        'role' => 'Role',
        'is_active' => 'Is Active?',
        'picture' => 'Profile Picture',
        'admin' => 'Administrator',
        'staff' => 'Staff',
        'active' => 'Active',
        'nonactive' => 'Nonactive',
        'reset_password' => 'Reset Password to Default?',
    ],
    'general' => [
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'deleted_at' => 'Deleted At',
        'created_by' => 'Created By',
    ],
    'config' => [
        'default_password' => 'Default Password',
        'page_size' => 'Page Size',
        'app_name' => 'Application Name',
        'institution_name' => 'Institution Name',
        'institution_address' => 'Institution Address',
        'institution_phone' => 'Institution Phone',
        'institution_email' => 'Institution Email',
        'language' => 'Language',
        'pic' => 'Person in Charge'
    ],

];
