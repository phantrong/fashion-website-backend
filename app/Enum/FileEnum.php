<?php

namespace App\Enum;

class FileEnum
{
    const TYPE_ALL = 1;
    const TYPE_IMAGE = 2;
    const TYPE_LIST = [
        self::TYPE_ALL,
        self::TYPE_IMAGE,
    ];

    const IMAGE_EXTENSION_JPG = 'jpg';
    const IMAGE_EXTENSION_JPEG = 'jpeg';
    const IMAGE_EXTENSION_PNG = 'png';
    const DOCUMENT_EXTENSION_PDF = 'pdf';
    const DOCUMENT_EXTENSION_DOCX = 'docx';
    const DOCUMENT_EXTENSION_XLSX = 'xlsx';
    const IMAGE_EXTENSION_LIST = [
        self::IMAGE_EXTENSION_JPG,
        self::IMAGE_EXTENSION_JPEG,
        self::IMAGE_EXTENSION_PNG,
    ];
    const ALL_EXTENSION_LIST = [
        self::IMAGE_EXTENSION_JPG,
        self::IMAGE_EXTENSION_JPEG,
        self::IMAGE_EXTENSION_PNG,
        self::DOCUMENT_EXTENSION_PDF,
        self::DOCUMENT_EXTENSION_DOCX,
        self::DOCUMENT_EXTENSION_XLSX,
    ];

    const FILE_NAME_SPECIAL_CHARACTER_NOT_ALLOWED = [
        ' ' => '-',
        '(' => '',
        ')' => '',
    ];
}
