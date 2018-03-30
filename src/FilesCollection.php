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

    private function fillFilesCollection(\Generator $filesData): void
    {
        foreach ($filesData as $fileData) {
            $this->append(new File($fileData));
        }
    }
}
