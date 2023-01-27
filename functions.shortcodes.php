<?php
class FAQ_Shortcodes
{
    const SHORTCODE_FAQ = "faq_generate";
    const SHORTCODE_FAQ_SINGLE = "faq_generate_single";

    public function __construct()
    {
        add_shortcode(self::SHORTCODE_FAQ, [$this, "faq_generate"]);
        add_shortcode(self::SHORTCODE_FAQ_SINGLE, [$this, "faq_generate_single"]);

    }


    public function faq_generate($atts)
    {

        $atts = shortcode_atts(
            array(
                'post' => 'faq',
                'number' => 3,
                'heading' => 'h3',
                'accordion' => 0,
                'answer-field' => 'answer'
            ), $atts, 'faq_generate' );


        $datas = get_posts([
            "post_type"     => $atts['post'],
            'post_status'   => 'publish',
            'numberposts'   => $atts['number']
        ]);
        
        if (isset($datas)){
            if ($atts['accordion']==1){
                ob_start();
                foreach ($datas as $data) {
                   ?>
                    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <<?php echo $atts['heading'] ?> itemprop="name" class="accFAQ_Title"><?php echo get_the_title($data); ?></<?php echo $atts['heading'] ?> >
                        <div itemscope class="accFAQ_answer" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div  itemprop="text">
                            <p><?php echo get_post_meta($data->ID, $atts['answer-field'], TRUE); ?> </p>
                        </div>
                        </div>
                    </div>
                    
                    <?php
                }

                ?> 
                <script>
                    var acc = document.getElementsByClassName("accFAQ_Title");
                    var i;

                    for (i = 0; i < acc.length; i++) {
                    acc[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        var panel = this.nextElementSibling;
                        if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                        } else {
                        panel.style.maxHeight = panel.scrollHeight + "px";
                        } 
                    });
                    }
                </script>
                <?php
                
                // generate json ld
                ?>

                <script type="application/ld+json">
                    {
                    "@context": "https://schema.org",
                    "@type": "FAQPage",
                    "mainEntity": [
                        <?php
                        $i=1;
                        $size = count($datas);
                        foreach ($datas as $data) {
                        ?>
                            
                        {
                        "@type": "Question",
                        "name": "<?php echo get_the_title($data); ?>",
                        "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "<?php echo get_post_meta($data->ID, $atts['answer-field'], TRUE); ?>"
                        }
                        <?php
                        if ($i < $size) {
                            echo '},';
                        }else{
                            echo '}';
                        }
                        $i++;
                        
                    }
                    ?>
                     
                    ]}
                    </script>

                <?php
                // end of generate_FAQ_LTd
        

                return ob_get_clean();
                
            }else {
                ob_start();
                foreach ($datas as $data) {
                   ?>
                    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <<?php echo $atts['heading'] ?> itemprop="name" class="FAQ_Title"><?php echo get_the_title($data); ?></<?php echo $atts['heading'] ?> >
                        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="FAQ_answer" itemprop="text">
                            <p> <?php echo get_post_meta($data->ID, $atts['answer-field'], TRUE); ?> </p>
                        </div>
                        </div>
                    </div>
                    <?php
                }

        // generate json ld
                ?>

                <script type="application/ld+json">
                    {
                    "@context": "https://schema.org",
                    "@type": "FAQPage",
                    "mainEntity": [
                        <?php
                        $i=1;
                        $size = count($datas);
                        foreach ($datas as $data) {
                        ?>
                            
                        {
                        "@type": "Question",
                        "name": "<?php echo get_the_title($data); ?>",
                        "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "<?php echo get_post_meta($data->ID, $atts['answer-field'], TRUE); ?>"
                        }
                        <?php
                        if ($i < $size) {
                            echo '},';
                        }else{
                            echo '}';
                        }
                        $i++;
                        
                    }
                    ?>
                     
                    ]}
                    </script>

                <?php
                // end of generate_FAQ_LTd

                return ob_get_clean();
            }
        }

        
    }
    
    public function faq_generate_single($atts)
    {

        $atts = shortcode_atts(
            array(
                'heading' => 'h1',
                'answer-field' => 'answer'
            ), $atts, 'faq_generate_single' );
        
                ob_start();
                   ?>
                    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <<?php echo $atts['heading'] ?> itemprop="name" class="FAQ_Title"><?php echo the_title_attribute(); ?></<?php echo $atts['heading'] ?> >
                        <div itemscope class="FAQ_answer" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div itemprop="text">
                            <p><?php echo get_post_meta(get_the_ID(), $atts['answer-field'], TRUE); ?> </p>
                        </div>
                        </div>
                    </div>
                    
                
                <script type="application/ld+json">
                    {
                    "@context": "https://schema.org",
                    "@type": "FAQPage",
                    "mainEntity": [  
                        {
                        "@type": "Question",
                        "name": "<?php echo get_the_title(); ?>",
                        "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "<?php echo get_post_meta(get_the_ID(), $atts['answer-field'], TRUE); ?>"
                        }
                        }       
                    ]}
                    </script>

                <?php
                // end of generate_FAQ_LTd

                return ob_get_clean();

        

        
    }

  
}
new FAQ_Shortcodes();
