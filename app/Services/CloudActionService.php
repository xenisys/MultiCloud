<?php namespace App\Services;

use App\Cloud;

class CloudActionService {

    protected $dropBoxService;

    protected $yandexDiskService;

    protected $googleDriveService;

    protected $contentService;

    public function __construct(DropBoxService $dropBoxService, YandexDiskService $yandexDiskService,
                                GoogleDriveService $googleDriveService, ContentService $contentService)
    {
        $this->dropBoxService = $dropBoxService;
        $this->yandexDiskService = $yandexDiskService;
        $this->googleDriveService = $googleDriveService;

        $this->contentService = $contentService;
    }

    public function getContents($cloud, $path)
    {
        $contents = [];

        if($cloud->type === Cloud::DropBox) {
            $contents = $this->dropBoxService->getContents($cloud->id, $path);
        }
        elseif($cloud->type === Cloud::GoogleDrive) {
        }
        elseif($cloud->type === Cloud::YandexDisk) {
            $contents = $this->yandexDiskService->getContents($cloud->id, $path);
        }

        return $contents;
    }

    public function shareStart($cloud, $path)
    {
        $url = '';

        if($cloud->type === Cloud::DropBox) {
            $url = $this->dropBoxService->shareStart($cloud->id, $path);
        }
        elseif($cloud->type === Cloud::GoogleDrive) {
            $url = $this->googleDriveService->shareStart($cloud->id, $path);
        }
        elseif($cloud->type === Cloud::YandexDisk) {
            $url = $this->yandexDiskService->shareStart($cloud->id, $path);
        }

        return $url;
    }

    public function shareStop($cloud, $path)
    {
        $response = false;

        if($cloud->type === Cloud::DropBox) {
            $response = $this->dropBoxService->shareStop($cloud->id, $path);
        }
        elseif($cloud->type === Cloud::GoogleDrive) {
            $response = $this->googleDriveService->shareStop($cloud->id, $path);
        }
        elseif($cloud->type === Cloud::YandexDisk) {
            $response = $this->yandexDiskService->shareStop($cloud->id, $path);
        }

        return $response;
    }

}