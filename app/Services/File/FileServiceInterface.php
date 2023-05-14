<?php

namespace App\Services\File;

use App\Enum\CommonEnum;

interface FileServiceInterface
{
    /**
     * Get file name and extension.
     *
     * @param $file
     * @return string
     */
    public function getNameAndExtension($file);

    /**
     * Get file extension.
     *
     * @param $file
     * @return string
     */
    public function getExtension($file);

    /**
     * Store file.
     *
     * @param $file
     * @param $folder
     * @return string
     */
    public function store($file, string $folder = CommonEnum::FOLDER_TEMP);

    /**
     * Copy an existing file to a new location on the disk.
     *
     * @param string $oldFilePath
     * @param string $newFilePath
     * @return bool
     */
    public function copy(string $oldFilePath, string $newFilePath);

    /**
     * Move an existing file to a new location on the disk.
     *
     * @param string $filePathFrom
     * @param string $filePathTo
     * @return bool
     */
    public function move(string $filePathFrom, string $filePathTo);

    /**
     * Delete file.
     *
     * @param string $filePath
     * @return bool
     */
    public function delete(string $filePath);

    /**
     * Delete multi file.
     *
     * @param array $fileUrls
     */
    public function deleteMultiFile(array $fileUrls);

    /**
     * Delete directory.
     *
     * @param string $directory
     * @return bool
     */
    public function deleteDirectory(string $directory);

    /**
     * Process move file from temp folder to other folder.
     *
     * @param string $filePath
     * @param string $newFolder
     * @param string $oldFolder
     */
    public function moveFile(string $filePath, string $newFolder, string $oldFolder = CommonEnum::FOLDER_TEMP);

    /**
     * Process move multi file.
     *
     * @param array $fileUrls
     * @param string $newFolder
     * @param string $oldFolder
     */
    public function moveMultiFile(array $fileUrls, string $newFolder, string $oldFolder = CommonEnum::FOLDER_TEMP);

    /**
     * Replace content after move file to other folder.
     *
     * @param $fileUrlArr
     * @param string $content
     * @param string $newFolder
     * @param string $oldFolder
     * @return string
     */
    public function replaceContentWithNewFileUrl(
        $fileUrlArr,
        string $content,
        string $newFolder,
        string $oldFolder = CommonEnum::FOLDER_TEMP
    );
}
