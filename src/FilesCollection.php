<?php

namespace Upload;

class FilesCollection extends \ArrayIterator
{
    public function __construct(string $field)
    {
        parent::__construct([]);
        $this->setUp($field);
    }

    private function setUp($field): void
    {
        $filesData = $this->reorganiseFilesData($_FILES[$field]);
        $this->fillFilesCollection($filesData);
    }

    private function reorganiseFilesData(array $files): \Generator
    {
        if (is_array($files['name'])) {
            return $this->setMultiFiles($files);
        }

        if (!is_array($files['name'])) {
            return $this->setSingleFile($files);
        }

        throw new \Exception('Input data Error', 1);
    }

    private function setMultiFiles(array $files): \Generator
    {
        for ($i = 0; $i < count($files['name']); $i++) {
            if (strlen($files['tmp_name'][$i]) > 0) {
                yield [
                    'name'     => $files['name'][$i],
                    'tmp_name' => $files['tmp_name'][$i],
                    'type'     => $files['type'][$i],
                ];
            }
        }
    }

    private function setSingleFile(array $file): \Generator
    {
        if ($file['size'] !== 0) {
            yield [
                'name'     => $file['name'],
                'tmp_name' => $file['tmp_name'],
                'type'     => $file['type'],
            ];
        }
    }

    private function fillFilesCollection(\Generator $filesData): void
    {
        foreach ($filesData as $fileData) {
            $this->append(new File($fileData));
        }
    }
}
