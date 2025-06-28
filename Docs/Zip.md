

#### ZIP Files
```
$zipObj		= \MTM\Compress\Facts::getArchives()->getZip();
```

##### Add a file by data
```
$data			= str_repeat("ABCD", 1000);
$fileName		= "report.csv";
		
$zipObj->addByData($fileName, $data);
```

##### Get the binary content of the zip file
```
$dataObj	= $zipObj->getFileData();
```
