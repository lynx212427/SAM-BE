<?php
class Island
{
    public $islandName;
    public $longDesc;
    public $content;
    public $contentImage;
    public $personalityImage;
    public $islandContentID;
    public $islandOfPersonalityID;

    public function __construct($islandName, $longDesc, $content, $contentImage, $personalityImage, $islandContentID, $islandOfPersonalityID)
    {
        $this->islandName = $islandName;
        $this->longDesc = $longDesc;
        $this->content = $content;
        $this->contentImage = $contentImage;
        $this->personalityImage = $personalityImage;
        $this->islandContentID = $islandContentID;
        $this->islandOfPersonalityID = $islandOfPersonalityID;
    }
    public function generatePersonalityHeader()
    {
        return '
            <div class="col-lg-12 mb-5">
                <div class="card mb-3">
                    <div class="card-header disgust-color">
                        <img src="' . $this->personalityImage . '" class="img-responsive mb-3 card-img-top" alt="Card Image">
                        <h3>' . $this->islandName . '</h3>
                        <p class="mx-4">' . $this->longDesc . '</p>
                    </div>
                    <div class="card-body">
                        <div class="row"> 
        ';
    }
    public function generateContentCard()
{
    return '
        <div class="col-md-6 col-lg-4 mb-4 d-flex justify-content-center">
            <div class="cards">
                <div class="image-container">
                    <img src="' . $this->contentImage . '" alt="Card Image">
                </div>
                <div class="popover">' . $this->content . '</div>
            </div>
        </div>
    ';
}
    public static function closePersonalitySection()
    {
        return '
                        </div> 
                    </div> 
                </div> 
            </div> 
        ';
    }
}
?>