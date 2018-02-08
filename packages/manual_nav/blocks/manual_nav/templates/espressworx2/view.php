<?php
defined('C5_EXECUTE') or die("Access Denied.");
$c = Page::getCurrentPage();
?>

<?php
if (count($rows) > 0) {
    $rows[0]['class'] = "nav-first";
    foreach ($rows as &$rowp) {
        if ($rowp['internalLinkCID'] === $c->getCollectionID()) {
            $rowp['class'] .= " nav-selected";
        }
    }
    ?>
    <nav class="navbar navbar-toggleable-md">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-ews" aria-controls="nav-ews" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa fa-bars" aria-hidden="true"></i>
    <i class="fa fa-chevron-up" aria-hidden="true"></i>
    </button>
    <div class="collapse navbar-collapse" id="nav-ews">
    <ul class="nav-ews clearfix">
        <?php  foreach ($rows as $row) { ?>
            <?php
            // create title
            $title = null;
            if ($row['title'] != null) {
                $title = $row['title'];
            } elseif ($row['collectionName'] != null) {
                $title = $row['collectionName'];
            } else {
                $title = t('');
            }

            $tag = "";
            if ($displayImage != 0) {
                if (is_object($row['image'])) {

                    if($row['isVectorImage']){
//                        $image = Core::make('html/image', array($row['image']));
//                        $tag = $image->getTag();
                        $tag = '<img src="' . $row['image']->getURL() . '" width="25px" height="25px">';
                    } else {
                        $im = Core::make('helper/image');
                        $thumb = $im->getThumbnail($row['image'], 30, 30);
                        $tag = new \HtmlObject\Image();
                        $tag->src($thumb->src)->width($thumb->width)->height($thumb->height);
                        $tag->alt(h($title));
                    }
                }
            }
            ?>

            <li class="<?php  echo $row['class'] ?>">

                <a href="<?php  echo $row['linkURL'] ?>" <?php  echo $row['openInNewWindow']  ?  'target="_blank"' : '' ?>>
                    <?php echo $tag; ?>
                    <?php echo h($title); ?>
                </a>
            </li>
        <?php  } ?>
    </ul>
  </div>
  </nav>
<?php  } else { ?>
    <div class="ccm-manual-nav-placeholder">
        <p><?php  echo t('No nav Entered.'); ?></p>
    </div>
<?php  } ?>
