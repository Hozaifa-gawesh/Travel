<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class GeneralController extends Controller
{

    public $model;
    protected $view = 'dashboard.';
    protected $url = 'dashboard/';
    protected $paginate = 12;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }



    /*************************************
     Start Path's
     ************************************/
    /**
     * Get View Path
     * @param $view
     * @return string
     */
    public function viewPath($view)
    {
        return $this->view . $view;
    }

    /**
     * Get URL Path
     * @param $url
     * @return string
     */
    public function urlPath($url)
    {
        return $this->url . $url;
    }
    /*************************************
    End Path's
     ************************************/



    /*************************************
    Start Quires Get Data
     ************************************/
    /**
     * Get data from Specific Model
     * @return mixed
     */
    public function getData()
    {
        return $this->model->orderBy('id', 'DESC');
    }


    /**
     * Get DESC Data without hidden items
     * @return mixed
     */
    public function dataOutHide()
    {
        return $this->getData()->where('hide', 0);

    }

    public function withOutHide()
    {
        return $this->model->where('hide', 0);
    }

    /**
     * Get Specific Item By ID
     * @param $id
     * @return mixed
     */
    public function GetItem($id)
    {
        return $this->validateModel($id);
    }


    /**
     * Get & Check Data By Slug
     * @param $slug
     * @return mixed
     */
    public function itemSlug($slug)
    {
        // Get Data By Slug
        $data = $this->model->where('slug', $slug)->first();
        // Check Data
        if(!$data) abort(404);
        return $data;
    }

    /**
     * Get Setting Data
     * @return mixed
     */
    public function setting()
    {
        return Setting::first();
    }


    /**
     * Show Data in DB
     * @param $id
     * @return mixed
     */
    public function showData($id)
    {
        // Get & Check Data
        return $this->validateModel($id)->update(['hide' => 0]);
    }


    /**
     * Hidden Data in DB
     * @param $id
     * @return mixed
     */
    public function hiddenData($id)
    {
        // Get & Check Data
        return $this->validateModel($id)->update(['hide' => 1]);
    }


    /**
     * Update Meta in DB
     * @param $page
     * @return mixed
     */
    public function GetMeta($page)
    {
        // Get and Check Data
        $data = Meta::where('page', $page)->first();
        // Check Get Data
        if(!$data) abort(404);
        // Return Data
        return $data;
    }


    /**
     * Update Meta in DB
     * @param $inputs
     * @param $page
     */
    public function UpdateMeta($inputs, $page)
    {
        // Get and Check Data
        $data = Meta::where('page', $page)->first();
        // Check Get Data
        if(!$data) abort(404);
        // Update Data in DB
        $data->update($inputs);
    }
    /*************************************
    End Quires Get Data
     ************************************/



    /*************************************
    Start Uploading Files
     ************************************/
    /**
     * Upload File
     * @param $file
     * @param $path
     * @param null $type
     * @param null $width
     * @param null $height
     * @param null $thumbnailWidth
     * @param null $thumbnailHeight
     * @param null $ratio
     * @param null $thumbnailRatio
     * @param int $qualityImg
     * @return bool|string
     */
    public function storeFile($file, $path, $type, $width = null, $height = null, $thumbnailWidth = null, $thumbnailHeight = null, $ratio = null, $thumbnailRatio = null, $qualityImg = 80)
    {
        if($file != null) {
            // Rename File
            $newFile = date('ymdgis') . mt_rand(100, 1000000) . '.' . $file->getClientOriginalExtension();
            $fileName = $path . '/' . $newFile;
            $specificPath = 'images/' . $path;
            $thumbnailSpecificPath = 'images/thumbnail/' . $path;
            $fullPath = 'images/' . $path . '/' . $newFile;
            $fullThumbnailPath = 'images/thumbnail/' . $path . '/' . $newFile;
            $quality = $qualityImg;

            // Move File
            if ($type === 'file') {
                $file->move('files/' . $path, $newFile);
                return $fileName;

            } elseif ($type === 'image') {
                $image = Image::make($file);
                $thumbnailImage = Image::make($file);
                // If Width and Height not Null
                if($width != null && $height != null) {
                    // Resize image as specific width and height
                    $image->resize($width, $height);
                }
                // If Ratio and Width or Height not Null
                if($ratio != null && ($width != null || $height != null)) {
                    // If need specific width and auto height
                    $image->resize($width, $height, function ($ration) {
                        $ration->aspectRatio();
                    });
                }
                // If Thumbnail Width and Height not Null
                if($thumbnailWidth != null && $thumbnailHeight != null) {
                    // Resize Thumbnail image as specific width and height
                    $thumbnailImage->resize($thumbnailWidth, $thumbnailHeight);
                }
                // If ThumbnailRatio and ThumbnailWidth or ThumbnailHeight not Null
                else if($thumbnailRatio != null && ($thumbnailWidth != null || $thumbnailHeight != null)) {
                    // If need specific width and auto height
                    $thumbnailImage->resize($thumbnailWidth, $thumbnailHeight, function ($thumbnailRatio) {
                        $thumbnailRatio->aspectRatio();
                    });
                }
                // If Existing Specific Path
                if(File::exists($specificPath) && File::exists($thumbnailSpecificPath)) {
                    // Save Image in the Full Path
                    $image->save($fullPath, $quality);
                    if(($thumbnailWidth != null && $thumbnailHeight != null) || ($thumbnailRatio != null && ($thumbnailWidth != null || $thumbnailHeight != null))) {
                        $thumbnailImage->save($fullThumbnailPath, $quality);
                    }

                } else {
                    // Generate Path Needed
                    File::makeDirectory($specificPath, 0777, true, true);
                    // Save Image in the Path Generated
                    $image->save($fullPath, $quality);
                    if(($thumbnailWidth != null && $thumbnailHeight != null) || ($thumbnailRatio != null && ($thumbnailWidth != null || $thumbnailHeight != null))) {
                        File::makeDirectory($thumbnailSpecificPath, 0777, true, true);
                        $thumbnailImage->save($fullThumbnailPath, $quality);
                    }
                }
                return $fileName;
            }
        }

        return null;
    }


    /**
     * Update File
     * @param $file
     * @param $path
     * @param $oldFile
     * @param $type
     * @param null $width
     * @param null $height
     * @param null $thumbnailWidth
     * @param null $thumbnailHeight
     * @param null $ratio
     * @param null $thumbnailRatio
     * @param int $qualityImg
     * @return bool|string
     */
    public function updateFile($file, $path, $type, $oldFile, $width = null, $height = null, $thumbnailWidth = null, $thumbnailHeight = null, $ratio = null, $thumbnailRatio = null, $qualityImg = 80)
    {
        if($file != null) {

            // Rename File
            $newFile = date('ymdgis') . mt_rand(100, 1000000) . '.' . $file->getClientOriginalExtension();
            $fileName = $path . '/' . $newFile;
            $specificPath = 'images/' . $path;
            $thumbnailSpecificPath = 'images/thumbnail/' . $path;
            $fullPath = 'images/' . $path . '/' . $newFile;
            $fullThumbnailPath = 'images/thumbnail/' . $path . '/' . $newFile;
            $quality = $qualityImg;

            // Move File
            if ($type === 'file') {
                if ($file->move('files/' . $path, $newFile)) {
                    // Delete old file
                    File::Delete('files/' . $oldFile);
                    return $fileName;
                }

            } elseif ($type === 'image') {
                $image = Image::make($file);
                $thumbnailImage = Image::make($file);
                // If Width and Height not Null
                if($width != null && $height != null) {
                    // Resize image as specific width and height
                    $image->resize($width, $height);
                }
                // If Ratio and Width or Height not Null
                else if($ratio != null && ($width != null || $height != null)) {
                    // If need specific width and auto height
                    $image->resize($width, $height, function ($ration) {
                        $ration->aspectRatio();
                    });
                }
                // If Thumbnail Width and Height not Null
                if($thumbnailWidth != null && $thumbnailHeight != null) {
                    // Resize Thumbnail image as specific width and height
                    $thumbnailImage->resize($thumbnailWidth, $thumbnailHeight);
                }
                // If ThumbnailRatio and ThumbnailWidth or ThumbnailHeight not Null
                else if($thumbnailRatio != null && ($thumbnailWidth != null || $thumbnailHeight != null)) {
                    // If need specific width and auto height
                    $thumbnailImage->resize($thumbnailWidth, $thumbnailHeight, function ($thumbnailRatio) {
                        $thumbnailRatio->aspectRatio();
                    });
                }
                // If Existing Specific Path
                if(File::exists($specificPath) && File::exists($thumbnailSpecificPath)) {
                    // Save Image in the Full Path
                    $image->save($fullPath, $quality);
                    if(($thumbnailWidth != null && $thumbnailHeight != null) || ($thumbnailRatio != null && ($thumbnailWidth != null || $thumbnailHeight != null))) {
                        $thumbnailImage->save($fullThumbnailPath, $quality);
                    }

                } else {
                    // Generate Path Needed
                    File::makeDirectory($specificPath, 0777, true, true);
                    // Save Image in the Path Generated
                    $image->save($fullPath, $quality);
                    if(($thumbnailWidth != null && $thumbnailHeight != null) || ($thumbnailRatio != null && ($thumbnailWidth != null || $thumbnailHeight != null))) {
                        File::makeDirectory($thumbnailSpecificPath, 0777, true, true);
                        $thumbnailImage->save($fullThumbnailPath, $quality);
                    }
                }

                // Delete old file
                File::Delete('images/'. $oldFile);
                File::Delete('images/thumbnail/'. $oldFile);
                return $fileName;
            }
        }

        return $oldFile;
    }
    /*************************************
    End Uploading Files
     ************************************/



    /*************************************
    Start Validation
     ************************************/
    /**
     * Validation $id in Model
     * @param $id
     * @return mixed
     */
    public function validateModel($id)
    {
        // Get data Category
        $data = $this->model->find($id);
        // if not exist data Category
        if(!$data)
            abort(404);

        return $data;
    }
    /*************************************
    End Validation
     ************************************/



    /*************************************
    Start Responses Data Json
     ************************************/
    /**
     * Get Success Message
     * @param $data
     * @param $message
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($data, $message = null, $type = null)
    {
        // Set array response data
        $response = [
            'status' => true,
            'message' => $message,
        ];
        // Check if Type Equal NULL
        if($type !== null) {
            $response['type'] = $type;
        }
        // Set Data in Response Array
        $response['data'] = $data;
        // return response data
        return response()->json($response, 200);
    }


    /**
     * Get Error Response
     * @param $error
     * @param array $errorMessage
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function errorResponse($error, $errorMessage = [], $code = 404)
    {
        // Set array response data
        $response = [
            'status' => false,
            'message' => $error
        ];

        // If not empty errors message => set item data in response array
        if(!empty($errorMessage)) {
            $response['errors'] = $errorMessage;
        }

        // return response data
        return response()->json($response, $code);
    }


    /**
     * Show MSG Error Response
     * @return \Illuminate\Http\JsonResponse
     */
    public function InvalidData()
    {
        return $this->errorResponse(__('lang.invalid_data'));
    }


    /**
     * Validation API Request
     * @param $id
     * @return mixed
     */
    public function ValidationAPI($id)
    {
        // Get data Item
        $data = $this->model->find($id);
        // if not exist data Category
        if(!$data)
            return $this->InvalidData();
        return $data;
    }


    /**
     * Get Specific Item By ID
     * @param $id
     * @return mixed
     */
    public function GetApiItem($id)
    {
        return $this->model->find($id);
    }
    /*************************************
    End Responses Data Json
     ************************************/



    /*************************************
    Start Get User Login Guards
     ************************************/
    /**
     * Get User Logged APi
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function userApi()
    {
        return auth('api')->user();
    }

    /**
     * Get Admin Logged
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function admin()
    {
        return auth('admin')->user();
    }
    /*************************************
    Start Get User Login Guards
     ************************************/



    /*************************************
    Start General Functions
     ************************************/
    /**
     * Code Generate
     * @return string
     */
    public function code()
    {
        return sha1(uniqid('_m') . md5(date('Ymdhis'))) . md5(uniqid('_m') . sha1(date('Ymdhis')));
    }


    /**
     * Generate Code
     * @param $count
     * @return string
     */
    public function codeGenerate($count)
    {
        return str_random($count);
    }


    /**
     * Check Key Generated
     * @param $countKey
     * @return string
     */
    public function keyUser($countKey)
    {
        do{
            $key = $this->codeGenerate($countKey);
            $user = $this->model->where('verification_key', $key)->first();
        } while($user);

        return $key;
    }


    /**
     * Delete Images from folders
     * @param $image
     * @param null $icon
     * @return bool
     */
    public function deleteImage($image, $icon = null)
    {
        // Delete Image from images folder
        File::delete('images/'. $image);
        // Delete Thumbnail Image from Thumbnail folder
        File::delete('images/thumbnail/'.$image);
        // Delete Icon from images folder
        if($icon !== null) {
            File::delete('images/' . $icon);
            // Delete Thumbnail Icon from Thumbnail folder
            File::delete('images/thumbnail/' . $icon);
        }
        return true;
    }


    /**
     * Show Flash Message
     * @param $name
     * @param $msg
     */
    public function flash($name, $msg)
    {
        Session::flash($name, $msg);
    }

    /*************************************
    End General Functions
     ************************************/

}
