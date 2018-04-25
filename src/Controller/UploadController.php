<?php

namespace App\Controller;

use App\Entity\Attachment;
use App\Repository\AttachmentRepository;
use App\Repository\ClientsRepository;
use App\Repository\DriverRepository;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UploadController extends Controller
{

    /**
     * @var EntityManager
     */

    /**
     * @Route("/upload", name="upload")
     */
    public function index()
    {


        $temparr = [-5, -4, -3, -2, 1, 2, 5];

        function closestToZero($arr){
            $target = 0;
            $min = PHP_INT_MAX;
            if (count($arr) > 0){

            for ($i = 0; count($arr) > $i ; $i++){
                $distance = abs($arr[$i] - $target);
                if ($distance < $min){
                    $min = $distance;
                }
            }
            return $min;
            }
            return null;
        }

        var_dump(closestToZero($temparr));
        var_dump(closestToZero([]));



        function sumOfPrimes($n){
            $arr = [];
            $le = PHP_INT_MAX;
            $num = 0;
            for ($i = 2; $le > $i; $i++){
                if(isPrime($i)){
                    $arr[] = $i;
                }
                if (count($arr) >= $n){
                    foreach ($arr as $x){
                    $num += $x;

                     }
                    return $num;
                }
            }
        }

        function isPrime($number) {
        for ($i = 2; $i <= ($number / 2); ++$i) {
            if ($number % $i == 0) {
                return false;
            }
        }
    return true;
}

        var_dump(sumOfPrimes(100));


        function sumOfPrimesDev($n){
            $primes = [2];
            $i = 3;
            while(count($primes) < $n){
                $prime = true;
                foreach ($primes as $single){
                    if ($i % $single == 0){
                        $prime = false;
                        break;
                    }
                }
                if ($prime){
                    $primes[] = $i;
                }
                $i += 2;
            }
            return array_sum($primes);
        }

        var_dump(sumOfPrimesDev(1000));







        function sumOfPrimesBma($n){
            $arr = [];
            $le = PHP_INT_MAX;
            $num = 0;
            for ($i = 2; $le > $i; $i++){
                if(isBam($i)){
                    $arr[] = $i;
                }
                if ($i >= $n){
                    foreach ($arr as $x){
                        $num += $x;

                    }
                    foreach ($arr as $ar){
                       $split = str_split($ar);
                       foreach ($split as $single){
                         $next[] = $single;
                       };
                    }
                    return array_count_values($next);
                }
            }
        }

        function isBam($number) {
            for ($i = 2; $i <= ($number / 2); ++$i) {
                if ($number % $i == 0) {
                    return false;
                }
            }
            return true;
        }



        var_dump(sumOfPrimesBma(100));


        function fib(){
            $max = PHP_INT_MAX;
            $sum = 0;
            $array = [1,2];
            $ats = 0;
            for ($i = 0; $max > $i; $i++){
                    $num = $array[count($array)-2] + end($array);
                    if ($num <= 4000000){
                        $array[] = $num;

                }else{
                        foreach ($array as $value){
                            if ($value % 2 === 0){
                    $sum += $value;
                }
                        }
                        return $sum;
                    }

            }

        }

        var_dump(fib());



        function largestPrimeFactor($n){
            $arr = [];
            $le = PHP_INT_MAX;
            $num = 0;
            for ($i = 2; $le > $i; $i++){
                if(isPrimesss($i)){
                    if ($i % $n === 1){
                        return $i;
                    }
                }
            }
        }


        function isPrimesss($number) {
            for ($i = 2; $i <= ($number / 2); ++$i) {
                if ($number % $i == 0) {
                    return false;
                }
            }
            return true;
        }
        var_dump(largestPrimeFactor(600851475143));

        die;
//        $arr = [
//            [
//                'name' => 'Tomka',
//                'skills' => [
//                    'PHP',
//                    'Svarscik',
//                    'Automehanik',
//                    'Gitler'
//                ]
//            ],
//            [
//                'name' => 'Komka',
//                'skills' => [
//                    'CSS',
//                    'HTML',
//                    'Kebul tvarken'
//                ]
//            ]
//        ];
//
//        $find = 'Kebul tvarken';
//        function recursive_in_array($needle, $haystack){
//            if (in_array($needle, $haystack)) {
//                return true;
//            }
//        foreach ($haystack as $value){
//                if (is_array($value) && recursive_in_array($needle, $value)){
//                    return true;
//            }
//        }
//        return  false;

//            for ($b = 0 ; count($))
//                for ($i = 0 ; count($arr) > $i; $i++){
//                    if ($arr[$i][$level] ){
//                        return true;
//                    }elseif ($arr[$i])
//         }
//            }
//
//
//        }
////        var_dump(recursive_in_array($find, $arr));
//        $nubArr = [1, 5, 8, 2, 6, 7];
//        function recursive_array_search($needle, $haystack){
//            $index = array_search($needle, $haystack);
//
//            if ($index !== false){
//                return [$index];
//            }
//
//            foreach ($haystack as $key => $value){
//                if(! is_array($value)){
//                    continue;
//                }
//
//                $index = recursive_array_serach($needle, $value);
//                if ($index !== false){
//                    return array_merge([$key],$index);
//                }
//            }
//            return false;
//        }
//
////        var_dump(recursive_array_search('Kebul tvarken', $arr));
//
//
//
//        function getMin($arr){
//            if (!empty($arr)) {
//                $bam = $arr[0];
//                foreach ($arr as $x) {
//                    if ($x < $bam) {
//                        $bam = $x;
//                    }
//                }
//                return $bam;
//            }
//            return null;
//        }
//
//        var_dump(getMin($nubArr));
//
//        function getMax($arr){
//            if (!empty($arr)){
//                $bam= PHP_INT_MIN;
//                foreach ($arr as $x){
//                    if ($bam<$x){
//                        $bam=$x;
//                    }
//                }
//                return $bam;
//            }
//            return null;
//        }
//
//        var_dump(getMax($nubArr));
//        var_dump(getMax([]));
//
//        function sumOfEvenNumbers($arr){
//            $num = 0;
//            foreach ($arr as $x){
//                if ($x % 2 === 0){
//                    $num += $x;
//                }
//            }
//            return $num;
//        }
//
//        var_dump(sumOfEvenNumbers($nubArr));
//
////        $nubArr = [1, 5, 8, 2, 6, 7];
//
//        function sortArray($arr){
//            for ($i = 0 ; $i < count($arr) ; $i++){
//                for ($j = 0; $j < count($arr); $j++){
//                    if ($arr[$j] > $arr[$i]){
//                        $temp = $arr[$i];
//                        $arr[$i] = $arr[$j];
//                        $arr[$j]=$temp;
//                    }
//                }
//            }
//            return $arr;
//        }
//
//        var_dump(sortArray($nubArr));
//
//
////        arr 1 5
////        key 0 1
//
//
//        $find = 'Kebul tvarken';
//        for ($i = 0 ; count($arr) > $i; $i++){
//            if (array_search($find, $arr[$i]['skills'])){
//                echo $arr[$i]['name'];
//            }
//        }
//
//        die;
//
//
////        return $this->render('upload/index.html.twig', [
////            'controller_name' => 'UploadController',
////        ]);
    }

    /**
     * @Route("/attachment")
     */
    public function attachment(Request $request, AttachmentRepository $attachmentRepository)
    {
        $files = $attachmentRepository->findAll();
        $attachment = new Attachment();
        $form = $this->createFormBuilder($attachment)
            ->add('file', FileType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $data = $form->getData();

            $file = $data->getFile();
            $filename = md5(uniqid()) .'.' .$file->guessClientExtension();
                $file->move(
                    $this->getParameter('attachment_folder'),
                    $filename
                );

                $attachment->setFile($filename);
            $em = $this->getDoctrine()->getManager();
                $em->persist($attachment);
                $em->flush();
        }
        return $this->render('upload/index.html.twig',[
           'form' => $form->createView(),
            'files' => $files,
        ]);
    }

//    /**
////     * @Route("/send")
////     */
//    public function send()
//    {
//        $client = new \GuzzleHttp\Client();
//        $request = $client->request('POST', 'https://127.0.0.1/some-post', [
//            'body' => 'username=aivaras&password=taip'
//        ]);
//        $body = $request->getBody();
//        $body = json_decode($body, true);
//
//
//        echo '<pre>';
//        var_dump($body);
//        echo '</pre>';
//        exit;
//    }

    /**
     * @Route("/some-post", methods="GET")
     */
    public function samePOST(DriverRepository $driverRepository)
    {
        $dri = $driverRepository->findAll();

        foreach ($dri as $di){
            dump($di);
            exit;
        }

        return new JsonResponse($dri);
    }

    /**
     * @Route("/getdrivers")
     */
    public function rivers(DriverRepository $driverRepository, ClientsRepository $clientsRepository)
    {
        $drivers = $driverRepository->findAll();
        return $drivers;
//        foreach ($drivers as $dri)
//        {
//
//        }
//        echo json_encode($bam);
    }

    /**
     * @Route("/guzzle")
     */
    public function guzzle()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->request('GET', 'http://uber.lt/some-post');
        $body = $request->getBody();
        $body = json_decode($body, true);

        echo '<pre>';
        dump($request->getHeaders());
        var_dump($body);
        echo '</pre>';
        exit;
    }

    /**
     * @Route("/test")
     */
    public function test()
    {
        return $this->render('test.html.twig');
    }



}
