<?php

namespace App\Services\File;

use App\Enum\CommonEnum;
use App\Enum\FileEnum;
use App\Services\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService implements FileServiceInterface
{
    /**
     * Get file name and extension.
     *
     * @param $file
     * @return string
     */
    public function getNameAndExtension($file)
    {
        return $file->getClientOriginalName();
    }

    /**
     * Get file extension.
     *
     * @param $file
     * @return string
     */
    public function getExtension($file)
    {
        return $file->getClientOriginalExtension();
    }

    /**
     * Store file.
     *
     * @param $file
     * @param string $folder
     * @return string
     */
    public function store($file, string $folder = CommonEnum::FOLDER_TEMP)
    {
        $fileSystemDisk = config('filesystems.default');
        $visibility = config("filesystems.disks.$fileSystemDisk.visibility");
        $domainFileUrl = config("filesystems.disks.$fileSystemDisk.url");

        $dataFile = file_get_contents($file);
        $currentDate = date('Y-m-d');
        $currentTime = time();
        $filePath = "$folder/$currentDate/$currentTime-" . $this->getNameAndExtension($file);
        $filePath = strtr($filePath, FileEnum::FILE_NAME_SPECIAL_CHARACTER_NOT_ALLOWED);
        Storage::disk($fileSystemDisk)->put($filePath, $dataFile, $visibility);

        return "$domainFileUrl/$filePath";
    }

    /**
     * Copy an existing file to a new location on the disk.
     *
     * @param string $oldFilePath
     * @param string $newFilePath
     * @return bool
     */
    public function copy(string $oldFilePath, string $newFilePath)
    {
        return Storage::disk(config('filesystems.default'))->copy($oldFilePath, $newFilePath);
    }

    /**
     * Move an existing file to a new location on the disk.
     *
     * @param string $filePathFrom
     * @param string $filePathTo
     * @return bool
     */
    public function move(string $filePathFrom, string $filePathTo)
    {
        return Storage::disk(config('filesystems.default'))->move($filePathFrom, $filePathTo);
    }

    /**
     * Delete file.
     *
     * @param string $filePath
     * @return bool
     */
    public function delete(string $filePath)
    {
        return Storage::disk(config('filesystems.default'))->delete($filePath);
    }

    /**
     * Delete multi file.
     *
     * @param array $fileUrls
     */
    public function deleteMultiFile(array $fileUrls)
    {
        foreach ($fileUrls as $fileUrl) {
            $this->delete($fileUrl);
        }
    }

    /**
     * Delete directory.
     *
     * @param string $directory
     * @return bool
     */
    public function deleteDirectory(string $directory)
    {
        return Storage::disk(config('filesystems.default'))->deleteDirectory($directory);
    }

    /**
     * Process move file from temp folder to other folder.
     *
     * @param string $filePath
     * @param string $newFolder
     * @param string $oldFolder
     */
    public function moveFile(string $filePath, string $newFolder, string $oldFolder = CommonEnum::FOLDER_TEMP)
    {
        $fileSystemDisk = config('filesystems.default');
        $filePathFrom = substr($filePath, strlen(config("filesystems.disks.$fileSystemDisk.url")));
        $filePathTo = Str::replace($oldFolder, $newFolder, $filePathFrom);
        if (Service::getFile()->move($filePathFrom, $filePathTo)) {
            $domainFileUrl = config("filesystems.disks.$fileSystemDisk.url");

            return $domainFileUrl . $filePathTo;
        }
    }

    /**
     * Process move multi file.
     *
     * @param array $fileUrls
     * @param string $newFolder
     * @param string $oldFolder
     */
    public function moveMultiFile(array $fileUrls, string $newFolder, string $oldFolder = CommonEnum::FOLDER_TEMP)
    {
        foreach ($fileUrls as $fileUrl) {
            $this->moveFile($fileUrl, $newFolder, $oldFolder);
        }
    }

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
    ) {
        $fileUrlArr = Arr::wrap($fileUrlArr);
        foreach ($fileUrlArr as $fileUrl) {
            $newFileUrl = Str::replace($oldFolder, $newFolder, $fileUrl);
            $content = Str::replace($fileUrl, $newFileUrl, $content);
        }

        return $content;
    }
}
