<?php 
    require('core/bootstrap.php');
    //header
    require('./components/header.php');
    $events = [
        [
            'title' => 'Rangoon Super Center Home Appliance E-commerce',
            'description' => 'We believe in the power of teamwork. Collaborating with our clients and colleagues allows us to achieve extraordinary results together',
        ],
        [
            'title' => 'Passion',
            'description' => 'Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.',
        ],
        [
            'title' => 'Innovation',
            'description' => 'Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.',
        ],
        [
            'title' => 'Continuous Improvement',
            'description' => 'Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.',
        ],
        [
            'title' => 'Client-Orientation',
            'description' => 'Lorem ipsum dolor sit amet elit. Aliquam odio dolor, id luctus erat sagittis non. Ut blandit semper pretium.',
        ],
    ];
?>

<section class="flex flex-col items-center justify-center px-6 py-16 ">
	<div class="text-xl font-bold leading-10 uppercase md:text-4xl text-gray-950 font-gosha">our core values</div>
	<div class="text-base font-normal leading-10 text-black capitalize md:py-4 md:text-xl text-opacity-80 font-space">Our Guiding Principles</div>
	<div class="relative w-full px-4 py-4 mx-auto sm:px-6 lg:px-8">
    <div class="absolute top-0 bottom-0 w-0 h-full transform -translate-x-1/2 bg-purple-500 md:w-2 left-1/2"></div>
    <?php foreach ($events as $i => $event) : ?>
      <div class="items-center w-[50%] flex container <?= $i % 2 === 0 ? 'left' : 'right' ?>">
        <div class="rounded-2xl top-[50% - 8px] absolute w-[157px]  container_clip h-full"></div>
        <div class=" p-2 flex justify-center items-center rounded-xl w-full  bg-white z-10 <?= $i % 2 === 0 ? ' mr-[15%] ' : 'ml-[15%]' ?>">
            <div class=" w-full rounded-2xl bg-gradient-to-r from-[#9C37FD] to-[#4a4d4e]  min-h-[88px]  p-[2px]">
                <div class="transition-all flex justify-center items-center flex-col w-full min-h-[88px] bg-white rounded-xl px-6 py-1">
                    <div class="flex items-center justify-between w-full">
                        <div class="w-4/5 text-lg font-bold leading-loose md:text-2xl text-gray-950 font-gosha"><?= $event['title'] ?></div>
                    </div>
                    <div class="flex items-start justify-between w-full mb-4">
                    <div class="text-sm font-medium leading-normal text-black md:text-base w-96 text-opacity-80 font-space">
                        <?= $event['description'] ?>
                    </div>
              </div>
          </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>



<section class="px-6 md:px-0 flex md:flex-row flex-col justify-between w-full lg:px-[10%] py-24 mx-auto items-between">
  <div class="flex flex-row-reverse items-start justify-between md:flex-col">
    <div class="flex flex-col items-end md:items-start">
      <div class="text-lg font-bold md:text-4xl text-gray-950 font-gosha">Discover Rangoon Super Center</div>
      <div class="mt-4 text-base font-normal text-black md:text-2xl font-space">
        Elevate your shopping experience with Rangoon Super Center.
      </div>
    </div>
    <img  class="w-2/5 bg-gray-900 rounded-full mr-7 md:mr-0 h-2/5 md:w-80 md:h-80" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/sidebar2-svg1.svg" alt="logo" />
  </div>
  <div class="md:mt-0 mt-5 flex flex-col justify-between items-start gap-y-3.5">
    <div class="md:w-[458px] bg-gradient rounded-lg p-[3px]">
      <div class="w-full h-full px-3 md:px-7 py-7 bg-[#e2c7fb] rounded-lg flex-col justify-start items-start gap-2.5 inline-flex">
        <div class="flex-col justify-start items-start gap-3.5">
          <div class="text-xl font-bold text-gray-9 00 md:text-3xl font-gosha">Our Identity</div>
          <div class="w-full text-sm font-normal md:text-xl text-gray-950 font-space">
            Uncover the essence of Rangoon Super Center
          </div>
        </div>
      </div>
    </div>
    <div class="md:w-[458px] bg-gradient rounded-lg p-[3px]">
      <div class="w-full h-full px-3 md:px-7 py-7 bg-white rounded-lg flex-col justify-start items-start gap-2.5 inline-flex">
        <div class="flex-col justify-start items-start gap-3.5">
          <div class="text-xl font-bold md:text-3xl text-gray-950 font-gosha">Our Mission</div>
          <div class="w-full text-sm font-normal md:text-xl text-gray-950 font-space">
            Empowering your lifestyle through quality products and unmatched service.
          </div>
        </div>
      </div>
    </div>
    <div class="md:w-[458px] bg-gradient rounded-lg p-[3px]">
      <div class="w-full h-full px-3 md:px-7 py-7 bg-white rounded-lg flex-col justify-start items-start gap-2.5 inline-flex">
        <div class="flex-col justify-start items-start gap-3.5">
          <div class="text-xl font-bold md:text-3xl text-gray-950 font-gosha">Our Values</div>
          <div class="w-full text-sm font-normal md:text-xl text-gray-950 font-space">
            Committed to excellence, integrity, and customer satisfaction
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require("./components/footer.php") ?>