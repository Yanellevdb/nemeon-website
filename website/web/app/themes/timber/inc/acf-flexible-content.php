<?php

class PostFlexible extends Timber\Post
{
    public function dynamic_context()
    {
        $blocks = array();
        if ($this->meta('blocks')) {
            foreach ($this->meta('blocks') as $block) {
                switch ($block['acf_fc_layout']) {
                    case 'anchor':
                        $block['template'] = 'anchor';
                        break;
                    case 'spacer':
                        $block['template'] = 'spacer';
                        break;
                    case 'hero_big':
                        $block['template'] = 'hero_big';
                        break;
                    case 'hero_small':
                        $block['template'] = 'hero_small';
                        break;
                    case 'text':
                        $block['template'] = 'text';
                        break;
                    case 'image':
                        $block['template'] = 'image';
                        break;
                    case 'embed':
                        $block['template'] = 'embed';
                        break;
                    case 'quote':
                        $block['template'] = 'quote';
                        break;
                    case 'form':
                        $block['template'] = 'form';
                        break;
                    case 'icon_block_columns':
                        $block['template'] = 'icon_block_columns';
                        break;
                    case 'content_grid':
                        $block['template'] = 'content_grid';
                        break;
                    case 'anchor':
                        $block['template'] = 'anchor';
                        break;
                    case 'cta_block':
                        $block['template'] = 'cta_block';
                        break;
                    case 'image_block':
                        $block['template'] = 'image_block';
                        break;
                    case 'pricing_blocks':
                        $block['template'] = 'pricing_blocks';
                        break;
                    case 'centered_content':
                        $block['template'] = 'centered_content';
                        break;
                    case 'text_block_columns':
                        $block['template'] = 'text_block_columns';
                        break;
                    case 'call_to_action':
                        $block['template'] = 'call_to_action';
                        break;
                    case 'slider':
                        $block['template'] = 'slider';
                        break;
                    case 'steps':
                        $block['template'] = 'steps';
                        break;
                    case 'testimonials':
                        $block['template'] = 'testimonials';
                        break;
                    case 'arrows_cta':
                        $block['template'] = 'arrows_cta';
                        break;
                    case 'arrows_cta_2_columns':
                        $block['template'] = 'arrows_cta_2_columns';
                        break;
                    case 'services_icons_block':
                        $block['template'] = 'services_icons_block';
                        break;
                    case 'customer_video':
                        $block['template'] = 'customer_video';
                        break;
                    case 'job_title':
                        $block['template'] = 'job_title';
                        break;
                    case 'job_content':
                        $block['template'] = 'job_content';
                        break;
                    case 'event_title':
                        $block['template'] = 'event_title';
                        break;
                    case 'event_content':
                        $block['template'] = 'event_content';
                        break;
                    case 'news_title':
                        $block['template'] = 'news_title';
                        break;
                    case 'news_content':
                        $block['template'] = 'news_content';
                        break;
                    case 'news_big_image':
                        $block['template'] = 'news_big_image';
                        break;
                    case 'news_images':
                        $block['template'] = 'news_images';
                        break;
                    case 'news_quote':
                        $block['template'] = 'news_quote';
                        break;
                    case 'event_hero':
                        $block['template'] = 'event_hero';
                        break;
                    case 'shortcode':
                        $block['template'] = 'shortcode';
                        break;
                    case 'hubspot_form':
                        $block['template'] = 'hubspot_form';
                        break;
                    case 'experts':
                        $block['template'] = 'experts';
                        break;
                    case 'full_width_banner':
                    $block['template'] = 'full_width_banner';
                    break;
                    case 'posts':
                        $block['template'] = 'posts';

                        for ($i = 0; $i < sizeof($block['post_column']); $i++) {
                            if ($block['post_column'][$i]['show'] == 'latest_two') {
                                $args = array(
                                  'posts_per_page'   => 2,
                                  'post_type'       => $block['post_column'][$i]['post_type']->name,
                                  'orderby'         => 'date',
                                  'order'           => 'DESC'
                                );
                                if ($block['post_column'][$i]['post_type']->name === 'post') {
                                    $block['post_column'][$i]['posts'] = Timber::get_posts($args);
                                } elseif ($block['post_column'][$i]['post_type']->name === 'jobs') {
                                    $block['post_column'][$i]['jobs'] = Timber::get_posts($args);
                                } elseif ($block['post_column'][$i]['post_type']->name === 'events') {
                                    $block['post_column'][$i]['events'] = Timber::get_posts($args);
                                }
                            } elseif ($block['post_column'][$i]['post_type']->name != 'post') {
                                $post_ids = [];

                                foreach ($block[$block['post_column'][$i]['post_type']->name] as $post) {
                                    array_push($post_ids, $post->ID);
                                }

                                $args = array(
                                  'post_type'       => $block['post_column'][$i]['post_type']->name,
                                  'post__in'        => $post_ids,
                                  'orderby'         => 'date',
                                  'order'           => 'DESC'
                                );

                                $block[$block['post_column'][$i]['post_type']->name] = Timber::get_posts($args);
                            }
                        }


                        break;
                        // case 'articles':
                        //   $block['template'] = 'articles';
                        //   $args = array(
                        //     'posts_per_page' 	=> 10,
                        //     'post_type'       => 'post',
                        //     'category'        => $block['categories'],
                        //     'orderby'         => 'date',
                        //     'order'           => 'DESC'
                        //   );
                        //   $block['posts'] = Timber::get_posts($args);
                        //   $block['posts'] = array_slice($block['posts'], 0, 10);

                        //   break;
                }

                $blocks[] = $block;
            }
        }

        return $blocks;
    }
}
