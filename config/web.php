<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'ru-RU',
    'name' => '<svg width="120" height="60" viewBox="0 0 120 60" xmlns="http://www.w3.org/2000/svg" class="injected-svg" data-src="/portal-v2-theme/assets/src/images/logo.036222e58a2f72dfb287756d6b84a5b6.svg" xmlns:xlink="http://www.w3.org/1999/xlink"><title>Untitled</title><g fill="none" fill-rule="evenodd"><path d="M62 0v60h58V0H62zM0 0v60h58V0H0z" fill="#0055A6"></path><path d="M117 3v54H65V3h52M31.423 42.467c-.639-.801-.962-1.853-.962-3.125 0-1.305.309-2.356.918-3.124.664-.841 1.642-1.267 2.908-1.267h.097v-2.178h-.097c-1.975 0-3.499.636-4.53 1.889-.938 1.135-1.414 2.714-1.414 4.697 0 1.916.516 3.491 1.534 4.682 1.071 1.252 2.564 1.888 4.439 1.888h.097v-2.178h-.097c-1.236 0-2.21-.432-2.893-1.284zm-7.522 0c-.639-.801-.963-1.852-.963-3.125 0-1.305.309-2.356.918-3.124.664-.841 1.642-1.267 2.908-1.267h.097v-2.178h-.097c-1.975 0-3.499.636-4.53 1.889-.938 1.135-1.414 2.714-1.414 4.697 0 1.916.517 3.491 1.535 4.682 1.071 1.252 2.564 1.888 4.439 1.888h.097v-2.178h-.097c-1.236 0-2.21-.432-2.893-1.284zm6.913-21.211v6.063h2.246V14.767h-2.246v4.372h-1.222c-.504 0-.88-.118-1.118-.351-.172-.165-.255-.385-.255-.674v-3.347h-2.246v3.584c0 .825.317 1.524.943 2.078.619.549 1.377.827 2.256.827h1.642zM52.3 32.475l-.158.17-4.487 4.819v-4.391h-1.962v12.481h1.962v-5.127l2.845-3.099.285 8.226h2L52.3 32.475zm-14.692-5.156h2.245V16.854h1.893v-2.086h-6v2.086h1.862v10.465zm5.172 5.326l-4.487 4.819v-4.391h-1.962v12.481h1.962v-5.127l2.845-3.099.284 8.226h2l-.483-13.08-.159.171zm4.039-15.791h.813c.579 0 .977.178 1.218.546.194.306.332.897.42 1.707h-2.505l.054-2.253zm-.094 4.339l2.803.001.63 6.126 2.262-.001-1.036-9.176c.001-1.203-.36-2.111-1.073-2.682-.567-.46-1.344-.694-2.309-.694h-3.327l-.413 12.552h2.246l.217-6.126zM7.583 16.854h2.781V27.32h2.246V14.767H5.337v12.552h2.246V16.854zm1.05 23.033c-.161.32-.349.48-.558.48-.203 0-.374-.138-.521-.424-.157-.303-.236-.746-.236-1.319v-3.673H7.4c.464 0 .818.264 1.083.805.272.558.41 1.449.41 2.652-.001.639-.088 1.137-.26 1.479zm-1.228-6.795H5.324v12.454h1.994v-3.62c.386.349.807.557 1.268.557.664 0 1.216-.361 1.643-1.072.478-.799.719-1.982.719-3.52 0-1.068-.194-2.027-.576-2.846-.602-1.295-1.601-1.953-2.967-1.953zm13.36-8.843c-.292.813-.704 1.208-1.257 1.208-.53 0-.93-.4-1.223-1.224-.306-.861-.461-1.953-.461-3.246 0-1.327.152-2.419.453-3.246.286-.791.689-1.175 1.231-1.175.608 0 1.042.389 1.324 1.189.262.737.394 1.812.394 3.196 0 1.338-.155 2.447-.461 3.298zm1.734 1.419c.666-1.183 1.004-2.77 1.004-4.717 0-1.924-.35-3.5-1.038-4.684-.704-1.208-1.7-1.82-2.961-1.82-1.196 0-2.148.616-2.828 1.831-.666 1.186-1.004 2.764-1.004 4.689 0 1.993.323 3.602.961 4.783.652 1.21 1.618 1.824 2.871 1.824 1.273.001 2.281-.64 2.995-1.906zm-5.623 16.878c-.263.821-.65 1.237-1.148 1.237-.479 0-.855-.422-1.119-1.254-.274-.867-.414-1.966-.414-3.268 0-1.335.137-2.434.406-3.267.258-.799.637-1.204 1.126-1.204.555 0 .951.4 1.208 1.221.235.742.354 1.823.354 3.216.001 1.346-.138 2.462-.413 3.319zm1.483-7.974c-.625-1.193-1.509-1.799-2.629-1.799-1.062 0-1.907.609-2.511 1.811-.593 1.18-.895 2.748-.895 4.66 0 1.981.289 3.582.856 4.756.578 1.195 1.436 1.801 2.549 1.801 1.13 0 2.025-.634 2.66-1.887.593-1.173.894-2.75.894-4.687.001-1.914-.31-3.48-.924-4.655z" fill="#FFF"></path><path d="M79.438 19.657c.43.979 1.137 1.981 3.061 3.333.43.303.905.933.543 1.818-.363.886-1.043 2.145-.635 2.633.408.491 1.857.747 3.037.257 0 0 .249.769.68 1.258 0 0-.203.42-.883.211 0 0 .249.629-.091 1.305 0 0-.794-.139-1.134-.887 0 0-.318.584-.951.792 0 0-.522-.278-.408-1.351 0 0-.386.956-1.564 1.118 0 0-.68-.885.204-2.075 0 0-.636.584-1.79.305 0 0-.183-.606.86-1.447 0 0-1.18-.045-1.632-1.071 0 0 .498-.629 1.723-.489 0 0-1.134-.257-1.383-1.656 0 0 .816-.536 2.109.326 0 0-.228-.442-.771-.885-.546-.442-1.202-1.678-.975-3.495m4.742 14.059a3.423 3.423 0 0 1-.395-.694c.203 1.697.276 2.841 1.166 3.938 0 0 .538-.735.191-2.521a1.68 1.68 0 0 1-.48-.229s.204.725.077 1.456c0-.001-.321-.242-.559-1.95m-1.54-.176a5.315 5.315 0 0 1-.418-.638c-.075.984-.327 3.577.517 4.388 0 0 .579-.435.783-4.215-.122.211-.336.436-.441.559 0 0 .141 1.2-.277 2.046-.001 0-.421-.328-.164-2.14m-2.012 1.981c.71-.874.923-3.492.923-3.492.098-.067.195-.142.295-.223a1.46 1.46 0 0 0 .117-.105c-.001.096.004.194.012.293-.102 1.575-.223 3.199-.701 4.008-.469.793-1.329 1.203-1.329 1.203-.809-1.477.168-3.462.985-4.84.1-.04.201-.088.306-.143-.288 1.063-.832 2.325-.608 3.299m-2.003-4.545c-.006.17.025.306.047.379.009.027.02.066.039.105-.678.685-1.179 1.336-2.182 2.77-1.005 1.435-2.594 1.491-2.594 1.491.152-1.16.46-2.079 1.31-3.067.851-.99 1.938-1.893 2.739-2.493.205.099.474.16.813.119.025-.003.051-.006.079-.011a1.202 1.202 0 0 0-.209.422c-.605.357-2.361 1.274-3.074 2.75.001 0 1.113-.357 3.032-2.465m-1.261-1.446l.067-.122a1.07 1.07 0 0 1 .07-.113c-.652.262-2.98 1.165-3.733 1.565-.753.403-1.843 1.315-2.435 3.167 0 0 1.57.146 2.867-.957 1.295-1.105 2.806-2.645 3.451-3.136a1.45 1.45 0 0 1-.15-.17s-1.754 1.599-3.609 2.288c0 0 .398-.74 1.131-1.278.892-.652 1.561-.872 2.341-1.244m-1.33-1.09c.024-.064.051-.125.077-.184-.768.162-2.688.397-3.546.667-.856.271-2.408.917-3.329 2.721 0 0 1.352.43 3.901-.805 2.548-1.233 3.347-1.488 3.835-1.62a1.792 1.792 0 0 1-.807-.254c-1.017.464-2.377 1.017-3.727 1.052 0 0 .668-.484 1.365-.786a16.86 16.86 0 0 1 2.231-.791m.064-1.3c.25.121.441.182.767.217a1.966 1.966 0 0 0-.497.469c-.898.266-2.43.557-4.955.745-2.527.188-3.874-.291-3.874-.291.881-.553 2.284-1.115 3.233-1.303.949-.188 3.441-.169 4.533-.321.014.011.146.124.359.257-.918.085-2.876.18-3.887.705 0 0 1.866.257 4.321-.478m-.189-1.493c.127-.078.281-.154.468-.227-1.277-.398-3.035-1.033-5.675-1.212-1.938-.131-3.339-.017-4.062.176 0 0 1.764 1.279 3.781 1.731 2.017.452 3.656.165 4.855.175a2.09 2.09 0 0 1 .308-.394c-1.399.009-3.731-.364-4.565-.649.001.001 2.034-.436 4.89.4m-.007-1.546c.007.036.155.778.991 1.189-1.794-.809-5.333-1.275-7.233-2.087-2.571-1.098-3.039-2.469-3.039-2.469 2.224-.06 4.022.499 5.408.935 1.623.512 4.094 1.46 4.959 1.856-.324.014-.68.109-.979.315-1.209-.477-1.771-.677-2.867-.993-.865-.249-1.506-.298-2.045-.352 0 0 .76.518 2.015.932 1.243.407 1.782.475 2.79.674m-.136-2.018c.072.132.285.445.369.569-2.841-.489-5.963-2.698-6.928-4.066-.966-1.369-.691-3.414-.691-3.414.936.195 2.972 2 3.498 2.541.527.542 2.12 2.135 3.221 3.026l.346 1.027a117.57 117.57 0 0 0-2.764-2.193c-.537-.417-1.342-1.006-2.141-1.288 0 0 .736.987 1.33 1.467a14.991 14.991 0 0 0 1.958 1.367c.511.287.77.451 1.802.964" fill="#0055A6"></path><path d="M83.775 30.257c.086-.076.16-.153.223-.224.131.17.568.735.783 1.295.165.479.338 1.131.426 1.506.086.372.346 1.146.502 1.414 0 0-.692.089-1.204-.525-.503-.604-.675-1.211-.753-1.835a6.936 6.936 0 0 1 .023-1.631m-1.091.094a.883.883 0 0 0 .266.255l.092.049.098-.032c.086-.029.165-.062.24-.1.099.288.141.427.166.672.033.324.096.836-.023 1.254-.145.51-.441.82-.605 1.018 0 0-.451-.512-.582-.935-.135-.442-.184-.957-.017-1.483a2.1 2.1 0 0 1 .365-.698m-1.559.048a2.26 2.26 0 0 0 1.076-.436c.06.168.15.394.083.713-.068.32-.282.675-.593.931-.467.383-1.092.744-1.781.633 0 0-.158-.531 1.215-1.841m-.522-.889c.056.474.276.771.294.794-.162.198-.744 1.227-1.959 1.053 0 0-.328-.699.48-1.256.549-.377.809-.454 1.185-.591m.106-.878a2.551 2.551 0 0 1-1.262-.009l-.139-.033-.041-.14c-.624.524-1.365.61-1.619 1.082 0 0 .311.594 1.119.494a2.68 2.68 0 0 0 1.85-1.046c.018-.086.053-.241.092-.348m-1.401-.736c.116-.175.195-.447.437-.722a4.213 4.213 0 0 0-1.645.021c-.746.146-1.508.326-1.889 1.493 0 0 .479.419 1.35.237.736-.155 1.38-.482 1.747-1.029m-.316-1.267a1.905 1.905 0 0 1-.484-.667l-.064-.145c-.645-.271-1.32-.411-1.979-.158-.658.254-.834.547-1 .799 0 0 .73.629 1.571.653.842.027 1.618-.222 1.956-.482m.195-1.364c.111-.044.237-.084.378-.113-.286-.259-.568-.653-.705-1.245-.299.072-1.006.072-1.315-.05-.31-.122-.921-.13-1.397.196 0 0 .16.857 1.238 1.151 1.012.275 1.39.204 1.801.061m-.388-1.675l.143-.093c.019-.013.26-.165.672-.197-.347-.267-1.172-.979-1.76-1.32-.638-.369-1.699-.857-2.238-.93 0 0 .506 1.367 1.096 1.917.61.571 1.038.783 2.087.623m1.09-.628c-.258-.346-.461-.821-.611-1.383-.123-.457-.4-1.591-.566-1.885-.166-.294-.762-1.323-1.928-1.641 0 0-.311 1.338.276 2.399.504.914 1.542 1.878 2.829 2.51m6.464 6.228c.146.148.256.232.517.366 0 0 .371.729-.078 1.61a22.936 22.936 0 0 0-1.014 2.28s-.242-.035-.51-1.416c-.183-.936-.412-1.168-.652-1.488.261.136.474.178.49.181l.182.032.082-.166a1.936 1.936 0 0 0 .194-1.11c.418.01.642-.207.726-.319.008-.01.016-.019.021-.028l.042.058" fill="#0055A6"></path><path d="M76.455 18.615a7.275 7.275 0 0 0-.002.421l.023.329c-.686-.902-1.51-1.992-2.297-2.994-.539-.688-.992-1.104-1.499-1.439.427 1.274 1.188 2.29 1.73 2.797.54.506 1.321 1.363 2.083 1.885l.074.258c.059.237.148.479.275.708.178.321.412.639.688.944a17.067 17.067 0 0 0-.731-.345l-.236-.101c-2.097-1.144-4.178-3.512-5.02-5.163-.842-1.648-.492-3.561-.268-4.587.951.83 2.322 2.465 2.92 3.354.734 1.091 1.675 2.637 2.258 3.894v.039m29.413 7.032a2.901 2.901 0 0 0-.469-.227c1.278-.398 3.036-1.033 5.677-1.212 1.938-.131 3.336-.017 4.061.176 0 0-1.764 1.279-3.783 1.731-2.017.452-3.655.165-4.854.175-.079-.121-.167-.257-.308-.394 1.399.009 3.731-.364 4.564-.649.001.001-2.031-.436-4.888.4m.006-1.546c-.006.036-.155.778-.991 1.189 1.795-.809 5.334-1.275 7.234-2.087 2.571-1.098 3.039-2.469 3.039-2.469-2.223-.06-4.023.499-5.408.935-1.623.512-4.095 1.46-4.959 1.856.324.014.679.109.978.315 1.21-.477 1.771-.677 2.868-.993.864-.249 1.506-.298 2.045-.352 0 0-.762.518-2.016.932-1.243.407-1.779.475-2.79.674m.136-2.018c-.072.132-.284.445-.367.569 2.841-.489 5.963-2.698 6.929-4.066.965-1.369.689-3.414.689-3.414-.937.195-2.971 2-3.497 2.541-.527.542-2.121 2.135-3.221 3.026l-.346 1.027c.943-.78 2.065-1.653 2.764-2.193.537-.417 1.34-1.006 2.142-1.288 0 0-.737.987-1.331 1.467-.688.558-1.384 1.042-1.959 1.367-.508.287-.771.451-1.803.964m-.688-3.468c.002.127.006.271.002.421l-.025.329c.688-.902 1.512-1.992 2.299-2.994.539-.688.992-1.104 1.498-1.439-.426 1.274-1.188 2.29-1.729 2.797-.54.506-1.32 1.363-2.083 1.885l-.074.258a2.913 2.913 0 0 1-.275.708 5.24 5.24 0 0 1-.688.944c.222-.111.477-.233.731-.345l.236-.101c2.096-1.144 4.178-3.512 5.02-5.163.84-1.648.492-3.561.268-4.587-.952.83-2.322 2.465-2.921 3.354-.735 1.091-1.674 2.637-2.257 3.894v.039M79.136 31.636c-.864.89-2.687 2.883-2.515 5.048 0 0 1.692-.545 2.389-1.822.697-1.275 1.128-2.075 1.422-2.363a1.917 1.917 0 0 1-.561-.004l-.152-.026c-.43.804-1.281 2.122-2.047 2.581 0 0-.195-1.066 2.057-3.229.031-.089.077-.188.141-.3-.207.074-.441.12-.706.113m23.174-11.977c-.432.979-1.139 1.981-3.061 3.333-.43.303-.905.933-.543 1.818.363.886 1.043 2.145.633 2.633-.407.491-1.857.747-3.036.257 0 0-.248.769-.68 1.258 0 0 .204.42.884.211 0 0-.249.629.091 1.305 0 0 .793-.139 1.133-.887 0 0 .317.584.952.792 0 0 .521-.278.408-1.351 0 0 .386.956 1.563 1.118 0 0 .681-.885-.203-2.075 0 0 .634.584 1.79.305 0 0 .182-.606-.861-1.447 0 0 1.178-.045 1.633-1.071 0 0-.5-.629-1.723-.489 0 0 1.133-.257 1.382-1.656 0 0-.815-.536-2.106.326 0 0 .226-.442.77-.885.542-.442 1.2-1.678.974-3.495m-4.744 14.059c.172-.233.3-.467.395-.694-.201 1.697-.275 2.841-1.166 3.938 0 0-.537-.735-.189-2.521.149-.044.316-.116.479-.229 0 0-.204.725-.077 1.456-.001-.001.321-.242.558-1.95m1.54-.176a5.08 5.08 0 0 0 .42-.638c.073.984.325 3.577-.518 4.388 0 0-.58-.435-.782-4.215.121.211.336.436.439.559 0 0-.14 1.2.279 2.046.001 0 .42-.328.162-2.14m2.013 1.981c-.711-.874-.923-3.492-.923-3.492a3.685 3.685 0 0 1-.413-.328c.001.096-.003.194-.013.293.104 1.575.225 3.199.703 4.008.469.793 1.329 1.203 1.329 1.203.809-1.477-.169-3.462-.983-4.84a2.65 2.65 0 0 1-.307-.143c.287 1.063.83 2.325.607 3.299m2.002-4.545c.006.17-.025.306-.048.379-.008.027-.018.066-.037.105.676.685 1.179 1.336 2.182 2.77 1.004 1.435 2.594 1.491 2.594 1.491-.154-1.16-.461-2.079-1.311-3.067-.851-.99-1.939-1.893-2.738-2.493-.207.099-.475.16-.812.119a1.097 1.097 0 0 1-.08-.011c.107.143.172.287.209.422.605.357 2.363 1.274 3.074 2.75 0 0-1.113-.357-3.033-2.465m1.261-1.446l-.066-.122a1.07 1.07 0 0 0-.07-.113c.651.262 2.98 1.165 3.733 1.565.753.403 1.842 1.315 2.435 3.167 0 0-1.57.146-2.867-.957-1.297-1.105-2.807-2.645-3.452-3.136a1.47 1.47 0 0 0 .151-.17s1.754 1.599 3.607 2.288c0 0-.396-.74-1.129-1.278-.893-.652-1.56-.872-2.342-1.244m1.331-1.09a3.508 3.508 0 0 0-.079-.184c.769.162 2.689.397 3.547.667.858.27 2.408.917 3.328 2.721 0 0-1.35.43-3.9-.805-2.549-1.233-3.346-1.488-3.834-1.62.389-.03.663-.165.807-.254 1.018.464 2.376 1.017 3.726 1.052 0 0-.667-.484-1.366-.786a16.74 16.74 0 0 0-2.229-.791m-.063-1.3c-.25.121-.442.182-.768.217.178.117.347.268.498.469.898.266 2.429.557 4.955.745 2.526.188 3.873-.291 3.873-.291-.879-.553-2.284-1.115-3.232-1.303-.949-.188-3.442-.169-4.535-.321a2.975 2.975 0 0 1-.359.257c.92.085 2.877.18 3.888.705-.001 0-1.865.257-4.32-.478" fill="#0055A6"></path><path d="M98 30.257a2.344 2.344 0 0 1-.223-.224c-.133.17-.568.735-.783 1.295-.166.479-.34 1.131-.426 1.506-.087.372-.346 1.146-.502 1.414 0 0 .692.089 1.203-.525.503-.604.676-1.211.752-1.835A6.992 6.992 0 0 0 98 30.257m1.089.094a.893.893 0 0 1-.263.255l-.092.049-.1-.032a1.718 1.718 0 0 1-.238-.1c-.099.288-.141.427-.166.672-.033.324-.097.836.023 1.254.145.51.439.82.604 1.018 0 0 .453-.512.582-.935.136-.442.186-.957.018-1.483a2.082 2.082 0 0 0-.368-.698m1.561.048a2.267 2.267 0 0 1-1.078-.436c-.059.168-.148.394-.08.713.066.32.281.675.592.931.465.383 1.092.744 1.781.633 0 0 .158-.531-1.215-1.841m.522-.889c-.055.474-.276.771-.293.794.161.198.743 1.227 1.958 1.053 0 0 .328-.699-.479-1.256-.551-.377-.809-.454-1.186-.591m-.106-.878c.324.084.745.117 1.261-.009l.138-.033.043-.14c.623.524 1.363.61 1.618 1.082 0 0-.311.594-1.118.494a2.682 2.682 0 0 1-1.851-1.046 2.542 2.542 0 0 0-.091-.348m1.402-.736c-.117-.175-.196-.447-.438-.722a4.218 4.218 0 0 1 1.646.021c.746.146 1.508.326 1.888 1.493 0 0-.479.419-1.349.237-.738-.155-1.381-.482-1.747-1.029m.315-1.267c.188-.167.358-.384.483-.667l.063-.145c.648-.271 1.321-.411 1.979-.158.66.254.834.547 1.002.799 0 0-.73.629-1.572.653-.842.027-1.618-.222-1.955-.482m-.197-1.364a2.166 2.166 0 0 0-.375-.113c.286-.259.566-.653.703-1.245.301.072 1.008.072 1.317-.05.31-.122.921-.13 1.396.196 0 0-.156.857-1.238 1.151-1.014.275-1.389.204-1.803.061m.39-1.675l-.142-.093c-.02-.013-.262-.165-.674-.197.349-.267 1.174-.979 1.762-1.32.637-.369 1.697-.857 2.238-.93 0 0-.506 1.367-1.096 1.917-.611.571-1.039.783-2.088.623m-1.091-.628c.258-.346.463-.821.613-1.383.122-.457.4-1.591.566-1.885.167-.294.762-1.323 1.928-1.641 0 0 .31 1.338-.277 2.399-.507.914-1.541 1.878-2.83 2.51m-6.462 6.228a1.754 1.754 0 0 1-.517.366s-.371.729.078 1.61c.449.882.832 1.782 1.013 2.28 0 0 .242-.035.511-1.416.182-.936.412-1.168.651-1.488a1.92 1.92 0 0 1-.491.181l-.18.032-.084-.166a1.947 1.947 0 0 1-.193-1.11c-.418.01-.641-.207-.727-.319l-.02-.028-.041.058" fill="#0055A6"></path><path d="M102.64 31.636c.864.89 2.687 2.883 2.515 5.048 0 0-1.693-.545-2.39-1.822-.696-1.275-1.128-2.075-1.421-2.363.188.026.375.025.561-.004l.152-.026c.43.804 1.28 2.122 2.047 2.581 0 0 .194-1.066-2.057-3.229a1.996 1.996 0 0 0-.141-.3c.205.074.44.12.705.113M89.565 14.38c0-.159.593-.289 1.321-.289.73 0 1.322.13 1.322.289 0 .16-.592.289-1.322.289-.728 0-1.321-.128-1.321-.289m-4.487 1.565c0-.088.381-.158.854-.158.469 0 .85.07.85.158 0 .087-.381.158-.85.158-.473 0-.854-.071-.854-.158m6.068-.927a.262.262 0 0 1-.26.267.263.263 0 0 1-.26-.267c0-.147.116-.267.26-.267.145 0 .26.12.26.267m-1.676-.919c-.44-1.08-.733-1.874-.722-2.141.008-.163.194-.282.369-.337.175-.056.331-.066.448.025.229.181.442 1.636.521 2.242a1.849 1.849 0 0 0-.616.211m.803-.235c.111-.012.227-.02.342-.023-.07-.578-.264-1.542-.379-1.922-.114-.379-.261-.653-.502-.722 0 0 .188.529.29 1.077.102.548.183 1.071.249 1.59m-1.392 1.931c.484-.119.981-.652.981-.652-.782.117-.981.652-.981.652zm.726-.049c-.675.406-1.434.342-1.434.342.146-.274.284-.529.707-.84.424-.312 1.113-.39 1.385-.351-.06.209-.337.656-.658.849zm-2.523 1.145v-.057c-.666.087-1.451.05-1.451.05.042.255.145.448.32.567.043-.554 1.131-.56 1.131-.56zm-2.207-.735s.84.323 1.682.28c.84-.044 2.389-.062 2.891-.311 0 0-.084.323-.483.511 0 0 .212 0 .418.187 0 0-.121.267-.478.41 0 0 .641.684 1.324.635 0 0-.315.404-1.017.248-.7-.155-.925-.559-1.046-.715 0 0 .09.385.047.542 0 0-.308-.019-.549-.331 0 0 .176.312.211.573 0 0-.193.025-.539-.187 0 0 .072.192.086.416 0 0-.812-.268-1.205-.646 0 0-.006.26.014.411-.001 0-1.26-.131-1.356-2.023zm-.193.132c.029.41.133.815.271 1.101 0 0-.496-.385-.617-.708-.121-.326-.15-.549.346-.393m-.995 1.554a.208.208 0 0 0 .207-.21.21.21 0 0 0-.207-.212.21.21 0 0 0-.205.212c0 .117.093.21.205.21zm1.213-.248c.332.155.627.522.627.522-.502.119-.727.268-.727.268a1.395 1.395 0 0 0-1.753.006c-.521-.305-.623-1.045-.362-1.437.26-.392.847-.323 1.125-.256.176.574.792.759 1.09.897zm.737.653s.352.479.605.69c0 0-1.295-.012-1.621 1.14 0 0-.448-.704-.121-1.164.352-.497.677-.559 1.137-.666" fill="#0055A6"></path><path d="M87.061 18.533s.418.125.556.162c0 0 .007-.249-.005-.367.127.03.283.075.417.086 0 0 .417.958.743 1.344 0 0 .019.212-.162.535 0 0-.236-.566-.66-1.019-.241-.257-.393-.386-.889-.741m-1.102-.204c.135.037.801.252 1.125.491.406.298.684.64.641 1.23 0 0-.326-.465-.688-.677-.287-.167-.805-.634-1.078-1.044m.01-4.333c.123 0 .362.06.362.263 0 .205-.31.698-.394.918h-.006c-.084-.22-.395-.713-.395-.918 0-.203.24-.263.363-.263h.07m-.271 1.591c-.059-.288-.169-1.034-.342-1.199-.164-.157-.405-.172-.524-.164a.231.231 0 0 0-.198.303c.05.168.586.995.655 1.099.125-.021.101-.014.409-.039m.474 0c.061-.288.17-1.034.342-1.199.163-.157.406-.172.524-.164a.23.23 0 0 1 .198.303c-.049.168-.586.995-.656 1.099-.125-.021-.1-.014-.408-.039m.346-2.594H86.1v-.475h-.338v.475h-.42v.299h.42v.56h.338v-.56h.418v-.299m-5.066 3.064c.001-.091.007-.183.019-.273a2.05 2.05 0 0 0 .01-.592c-.299.118-.504.193-.918.88-.001 0 .66-.419.889-.015m.577 1.09c.009-.171.117-.709.255-1.09.169-.465.073-1.143-.13-1.553-.197-.396-.305-.77-.27-1.181 0 0-.393.135-.617.277-.037.477.233.953.363 1.225.152.32.121.737.087.993-.057.433.029.896.312 1.329m.045-3.644a.564.564 0 0 1 .014-.263s.615-.617 1.134-.722a.689.689 0 0 1 .624.165s-.182-.022-.457.208c-.275.231-.619.51-.879.58-.257.069-.313.048-.436.032m1.822-.774c.232.239.428.49.424.708-.004.227-.26.793-.394 1.011-.134.218-.33.499-.308.844.012.172.128.349.266.494 0 0-.754-.184-.846-.663-.082-.428.096-.729.217-.966.113-.222.461-.743.549-.959.08-.197.122-.361.092-.469m4.408 5.396c.151.547.407 1.062.659 1.467.227.367.371.968.35 1.171 0 0 .342-.773.166-1.32-.135-.421-.501-1.051-1.175-1.318m.848.181s.516.007.759.171c.312.212.606.672.72 1.226 0 0-.522-.093-.78-.358-.258-.267-.577-.664-.699-1.039m-2.677.96a3.71 3.71 0 0 0-.494.11s.441.132.66.319c.188.159.35.405.426.819.106.578.438 1.202.537 1.389l.04-.008c-.062-.398.181-1.224.241-1.342 0 0-.348-.226-.508-.461-.117-.172-.326-.459-.902-.826m2.292 1.241c.128.304.47.842.31 1.404-.16.562-.515.804-.736 1.279 0 0-.175-.858-.135-1.521.036-.663.272-.92.561-1.162m.993.023s.514 1.025.607 1.428c.09.397.007.663-.168.904-.175.241-.471.5-.742 1.007 0 0-.318-.429-.358-.656-.038-.226.023-.765.093-.991.067-.225.339-.951.568-1.692m.264 3.274c-.114.125-.715.868-.796 1.085-.08.217-.219.626-.033.91.188.284.615.739.99.932 0 0-.406-.652-.365-1.187.027-.341.283-.646.332-.855.049-.209.018-.56-.128-.885m-1.176-.411c.092.132.253.451.274.764.021.306-.026.553-.189 1.003a13.286 13.286 0 0 1-.672 1.482s-.283-.415-.438-.785c0 0 .441-.621.629-1.061.218-.517.31-.996.396-1.403m-.206-.24s-.189 1.459-1.024 2.544c-.564.734-1.025.989-1.328.989-.459 0-.92-.393-1.075-.843-.155-.45-.106-1.148.19-1.396 0 0 .276.876.863.908.664.038 1.519-.726 2.374-2.202" fill="#0055A6"></path><path d="M87.957 22.543c.07.261.092.662 0 1.04-.07.286-.24.663-.566.872-.281.181-.947.225-1.201-.422-.001 0 1.214.094 1.767-1.49m1.989 5.887c.167.438.762.994.759 1.336-.012.909-.396 1.465-.488 1.765 0 0-.707-.578-.833-1.241-.064-.339.011-1.358.562-1.86m-.791.641c.083-.235.343-.876.644-1.101 0 0 .387-1.166-.852-1.881 0 0-.509.695-.644 1.347s.541 1.047.852 1.635m-1.548-2.939c-.199.245-.479.587-.697.694 0 0-.073.521-.032.866.063.513.384 1.038.521 1.422 0 0 .541-.727.604-1.155.062-.428.051-.78.072-.983-.001 0-.302-.503-.468-.844m-1.425 2.493c-.153-.239-.65-1.122-.657-1.762 0 0 .611.333 1.122.089 0 0 .068.833-.031 1.115-.081.229-.186.366-.434.558m.14.179c.1-.088.343-.319.442-.441 0 0 .404.763.474.986 0 0-.203.053-.425-.113a3.241 3.241 0 0 1-.491-.432m1.875-.448c-.049.193-.704 1.128-.816 1.243 0 0 .051.339.293.826.242.487.58.827.76 1 0 0 .403-.725.523-1.044.137-.365.121-.725.062-.858-.136-.315-.611-.77-.822-1.167m.985 2.448c.143.302.58.794.648 1.185.053.307.005.557-.075.769-.081.211-.343.622-.519.937 0 0-.597-.58-.729-.994-.1-.312-.062-.756.082-1.031.143-.277.456-.579.593-.866m-1.695-.084c.156.347.524.694.61.999.1.359.131.589-.037 1.006-.15.369-.332.583-.394.807 0 0-.485-.645-.565-.914-.082-.27-.107-.713-.008-.994.101-.282.276-.649.394-.904m2.392 2.46s-.836 1.038-.816 1.588c.025.687.467 1.142.53 1.564 0 0 .437-.51.604-.852.187-.385.33-.712.281-1.147-.05-.435-.164-.716-.599-1.153m-1.539-.102c.132.198.506.877.399 1.281-.105.403-.517.973-.653 1.217 0 0-.332-.699-.406-1.019-.074-.32-.006-.838.66-1.479m8.355-17.133c0-.088-.381-.158-.852-.158-.47 0-.851.07-.851.158 0 .087.381.158.851.158.471 0 .852-.071.852-.158m-5.8-2.688c.056-.392.498-1.226.498-1.592a.514.514 0 0 0-.506-.52.514.514 0 0 0-.506.52c0 .366.443 1.2.497 1.592h.017m1.41.842c.441-1.08.733-1.874.722-2.141-.009-.163-.193-.282-.369-.337-.177-.056-.333-.066-.447.025-.229.181-.442 1.636-.521 2.242.222.045.357.073.615.211m-.803-.235a4.267 4.267 0 0 0-.342-.023c.069-.578.263-1.542.378-1.922.114-.379.261-.653.502-.722 0 0-.188.529-.29 1.077a27.754 27.754 0 0 0-.248 1.59m.412 1.28s.494.533.98.652c.001-.001-.201-.536-.98-.652zm-.406-.247c.271-.039.963.039 1.387.351.423.312.561.566.707.84 0 0-.76.064-1.436-.342-.318-.193-.596-.64-.658-.849zm4.313 2.554c.176-.119.278-.312.319-.567 0 0-.785.037-1.45-.05v.057s1.089.006 1.131.56zm-.278.728c.02-.15.013-.411.013-.411-.394.379-1.204.646-1.204.646.012-.224.084-.416.084-.416-.344.211-.539.187-.539.187.037-.262.213-.573.213-.573a.825.825 0 0 1-.551.331c-.042-.156.049-.542.049-.542-.121.156-.346.56-1.047.715-.703.156-1.017-.248-1.017-.248.685.049 1.325-.635 1.325-.635a.905.905 0 0 1-.479-.41c.207-.187.418-.187.418-.187-.4-.188-.484-.511-.484-.511.503.249 2.051.267 2.893.311.84.043 1.682-.28 1.682-.28-.098 1.892-1.356 2.023-1.356 2.023zm1.549-1.891c-.031.41-.133.815-.272 1.101 0 0 .495-.385.616-.708.122-.326.152-.549-.344-.393m1.197 1.344a.209.209 0 0 0-.206-.212.21.21 0 0 0-.206.212c0 .117.094.21.206.21a.207.207 0 0 0 .206-.21zm-.327-.934c.279-.067.866-.136 1.125.256.261.392.158 1.132-.361 1.437 0 0-.794-.703-1.755-.006 0 0-.225-.149-.727-.268 0 0 .297-.367.629-.522.297-.139.913-.324 1.089-.897zm-1.825 1.549s-.352.479-.605.69c0 0 1.295-.012 1.621 1.14 0 0 .447-.704.12-1.164-.352-.497-.677-.559-1.136-.666" fill="#0055A6"></path><path d="M94.715 18.533s-.418.125-.557.162c0 0-.007-.249.006-.367-.127.03-.285.075-.418.086 0 0-.417.958-.743 1.344 0 0-.019.212.163.535 0 0 .235-.566.659-1.019.239-.257.394-.386.89-.741m1.101-.204c-.135.037-.803.252-1.126.491-.405.298-.685.64-.642 1.23 0 0 .328-.465.689-.677.288-.167.806-.634 1.079-1.044m-.009-4.333c-.124 0-.363.06-.363.263 0 .205.311.698.393.918h.008c.082-.22.393-.713.393-.918 0-.203-.239-.263-.363-.263h-.068m.269 1.591c.059-.288.169-1.034.342-1.199.164-.157.404-.172.525-.164a.232.232 0 0 1 .198.303c-.05.168-.587.995-.657 1.099-.125-.021-.099-.014-.408-.039m-.474 0c-.059-.288-.168-1.034-.342-1.199-.164-.157-.404-.172-.525-.164a.232.232 0 0 0-.197.303c.051.168.586.995.656 1.099.125-.021.1-.014.408-.039m-.344-2.594h.417v-.475h.337v.475h.42v.299h-.42v.56h-.337v-.56h-.417v-.299m-5.019-2.812h.417v-.477h.338v.477h.419v.299h-.419v.559h-.338v-.559h-.417v-.299m10.083 5.876c0-.091-.007-.183-.02-.273a2.204 2.204 0 0 1-.01-.592c.301.118.504.193.918.88.001 0-.658-.419-.888-.015" fill="#0055A6"></path><path d="M99.744 17.147c-.008-.171-.117-.709-.254-1.09-.168-.465-.072-1.143.131-1.553.195-.396.305-.77.269-1.181 0 0 .392.135.616.277.037.477-.233.953-.361 1.225-.154.32-.122.737-.088.993.058.433-.03.896-.313 1.329m-.043-3.644a.54.54 0 0 0-.015-.263s-.615-.617-1.133-.722a.692.692 0 0 0-.625.165s.182-.022.457.208c.276.231.618.51.879.58.257.069.314.048.437.032m-1.824-.774c-.232.239-.427.49-.423.708.005.227.259.793.394 1.011.135.218.331.499.307.844-.013.172-.127.349-.264.494 0 0 .754-.184.846-.663.081-.428-.096-.729-.217-.966-.114-.222-.461-.743-.549-.959-.079-.197-.121-.361-.094-.469m-4.404 5.396a5.825 5.825 0 0 1-.66 1.467c-.229.367-.373.968-.35 1.171 0 0-.342-.773-.166-1.32.135-.421.498-1.051 1.176-1.318m-.852.181s-.516.007-.758.171c-.311.212-.607.672-.721 1.226 0 0 .523-.093.781-.358.259-.267.578-.664.698-1.039m2.68.96c.098.009.363.071.492.11 0 0-.44.132-.659.319-.188.159-.349.405-.425.819-.107.578-.438 1.202-.538 1.389l-.04-.008c.062-.398-.182-1.224-.242-1.342 0 0 .35-.226.51-.461.116-.172.326-.459.902-.826m-2.292 1.241c-.129.304-.47.842-.312 1.404.159.562.517.804.736 1.279 0 0 .176-.858.137-1.521-.038-.663-.273-.92-.561-1.162m-2.114 1.572c.021-.327.764-1.12.727-1.549-.039-.429-.594-.733-.73-.795h-.007c-.137.062-.691.366-.729.795-.038.429.703 1.222.726 1.549h.013m1.12-1.549s-.515 1.025-.607 1.428c-.089.397-.007.663.169.904.174.242.469.5.743 1.007 0 0 .317-.429.356-.656.037-.226-.023-.765-.092-.991-.068-.225-.342-.951-.569-1.692m-1.122 3.967c.236-.209.444-.518.51-.702.064-.184.084-.453-.072-.658-.188-.246-.422-.52-.438-.743h-.012c-.018.224-.25.497-.437.743-.155.205-.138.474-.071.658.064.184.275.493.511.702h.009m.859-.693c.112.125.713.868.794 1.085.081.217.219.626.031.91-.186.284-.612.739-.987.932 0 0 .405-.652.365-1.187-.027-.341-.285-.646-.334-.855-.049-.209-.016-.56.131-.885m1.176-.411a1.697 1.697 0 0 0-.275.764c-.021.306.027.553.191 1.003.205.567.521 1.199.671 1.482 0 0 .282-.415.437-.785 0 0-.441-.621-.628-1.061-.22-.517-.311-.996-.396-1.403m.205-.24s.189 1.459 1.024 2.544c.565.734 1.024.989 1.329.989.459 0 .918-.393 1.074-.843.154-.45.105-1.148-.191-1.396 0 0-.275.876-.862.908-.665.038-1.521-.726-2.374-2.202" fill="#0055A6"></path><path d="M93.818 22.543a2.24 2.24 0 0 0 0 1.04c.069.286.24.663.564.872.283.181.947.225 1.201-.422.001 0-1.214.094-1.765-1.49m-2.414 3.876c.155-.244.302-.695.218-1.015-.103-.396-.312-.556-.437-.803-.104.098-.167.174-.292.25h-.007c-.126-.076-.192-.152-.296-.25-.125.247-.334.407-.438.803-.081.32.064.771.22 1.015.197.31.343.374.515.458.173-.084.318-.148.517-.458zm-.517 2.919c.084-.385.87-1.133.797-1.54-.107-.609-.49-.48-.791-.738h-.006c-.303.257-.688.128-.796.738-.071.406.708 1.154.793 1.54h.003m.943-.908c-.168.438-.764.994-.76 1.336.01.909.395 1.465.488 1.765 0 0 .707-.578.831-1.241.064-.339-.009-1.358-.559-1.86m.789.641c-.084-.235-.344-.876-.645-1.101 0 0-.385-1.166.853-1.881 0 0 .509.695.646 1.347.134.652-.54 1.047-.854 1.635m1.549-2.939c.197.245.479.587.697.694 0 0 .072.521.031.866-.063.513-.385 1.038-.52 1.422 0 0-.542-.727-.605-1.155-.062-.428-.051-.78-.072-.983 0 0 .302-.503.469-.844m1.426 2.493c.152-.239.65-1.122.656-1.762 0 0-.611.333-1.122.089 0 0-.067.833.032 1.115.08.229.186.366.434.558m-.141.179a5.107 5.107 0 0 1-.443-.441s-.404.763-.474.986c0 0 .203.053.425-.113.222-.167.273-.209.492-.432m-1.875-.448c.049.193.704 1.128.814 1.243 0 0-.049.339-.293.826a3.638 3.638 0 0 1-.759 1s-.403-.725-.524-1.044c-.136-.365-.119-.725-.061-.858.137-.315.61-.77.823-1.167m-2.087 4.531c.093-.265.089-.573-.013-.783-.118-.244-.542-.845-.592-1.019-.053.174-.472.774-.591 1.019-.103.21-.106.519-.012.783.157.443.534.747.597 1.004h.012c.063-.257.44-.561.599-1.004zm1.103-2.083c-.145.302-.58.794-.648 1.185-.054.307-.006.557.074.769.08.211.344.622.518.937 0 0 .598-.58.729-.994.1-.312.063-.756-.08-1.031-.146-.277-.457-.579-.593-.866m1.694-.084c-.157.347-.526.694-.611.999-.099.359-.131.589.038 1.006.148.369.33.583.393.807 0 0 .484-.645.566-.914.082-.269.106-.713.008-.994-.102-.282-.276-.649-.394-.904m-3.401 8.13c.031-.316.667-1.294.697-2.332.016-.52-.436-1.332-.691-1.641h-.013c-.257.309-.704 1.121-.69 1.641.031 1.038.664 2.015.697 2.332m1.009-5.67s.836 1.038.816 1.588c-.024.687-.468 1.142-.53 1.564 0 0-.438-.51-.604-.852-.187-.385-.33-.712-.278-1.147.048-.435.159-.716.596-1.153m1.538-.102c-.131.198-.504.877-.398 1.281.105.403.518.973.654 1.217 0 0 .33-.699.405-1.019.074-.32.005-.838-.661-1.479" fill="#0055A6"></path><path d="M91.459 40.515c.051-.807.496-1.29.572-1.71.088-.461.059-.902-.291-1.435a13.17 13.17 0 0 1-.835 2.216l-.019.041-.017-.041a13.07 13.07 0 0 1-.836-2.216c-.348.532-.379.974-.292 1.435.079.42.523.903.572 1.71.051.808-.834 1.116-.834 1.116.299.109.639.158 1.178-.367.099-.096.174-.2.229-.311.057.11.131.215.23.311.539.525.878.477 1.176.367.001 0-.883-.309-.833-1.116m-2.783-5.367c.094.302.369.858.404 1.029.066.32-.023.707-.59 1.119 0 0-.368-.264-.514-.611-.135-.326-.057-.555.086-.723.141-.169.473-.56.614-.814m1.193 1.195c0 .162-.117 1.075-.369 1.528-.354.637-.876 1.111-1.331 1.111-.423 0-.512-.259-.722-.365 0 0 .107-.553.581-.698.584-.178 1.479-.898 1.841-1.576" fill="#0055A6"></path><path d="M88.348 37.507c-.098-.077-.184-.131-.301-.271 0 0-.451.172-.82.428-.371.256-.734.691-.93.92 0 0 .555.148.906-.017 0 0 .129-.545.523-.788.088-.053.365-.136.622-.272m-.463-.468c-.085-.137-.261-.391-.223-.787 0 0-.779.506-1.014.701-.235.195-.721.712-.829.882 0 0 .589-.132 1.042-.287.498-.171.842-.4 1.024-.509m-1.321.869c-.419.152-1.365.311-1.76.431-.396.12-.682.331-1.061.756 0 0 .58.165.891.268 0 0 .494-.347 1.034-.56.352-.139.523-.52.896-.895m-.877 2.865c.091-.102.204-.221.116-.462-.062-.177-.404-.37-.611-.474-.338-.165-1.278-.424-1.584-.517 0 0-.152.185-.234.379-.036.075.012.152.145.177.261.045.891-.075 1.044.027.166.11.108.26.108.407 0 0 .287-.18.467-.14.252.059.404.179.549.603m-.837-1.343c.068.023.434.139.791.371 0 0 .159-.062.236-.213.076-.144.398-.632.692-.697 0 0-.251-.025-.394-.071 0 0-.307.081-.523.171-.216.09-.487.228-.802.439m2.424-.617c-.058.027-.152.073-.372.083 0 0-.828.59-.924 1.177-.083.504.175.744.299.808.125.064.702.309 1.078-.486 0 0-.641.216-.814-.102-.174-.316.107-.777.282-.91.228-.175.64-.294.888-.248 0 0-.199-.197-.437-.322" fill="#0055A6"></path><path d="M81.859 45.561c.101-.432.212-.888.404-1.307.373-.812 1.29-2.979 3.2-3.361.181-.035-.206-.492-.378-.47-.17.022-.512.248-.662.351 0 0 0-.462-.005-.544-.005-.083-.075-.114-.15-.11-.072.001-.536-.004-.681.17-.436.518-1.171 1.912-1.586 2.951-.418 1.037-.703 1.354-1.143 1.194-.439-.157-.701-.676-1.469-.518-.264.053-.559.237-.789.508.063.126.145.28.504.28.357 0 1.04.155 1.422.43.382.272.783.364 1.333.426m7.627-6.715c.043.334.2.649.375.975 0 0-.582 2.761-2.686 2.975 0 0 .043-.572.666-1.009.623-.436 1.555-1.111 1.486-2.138 0 0-.166.035-.465.42-.299.385-.955 1.496-1.969 1.504 0 0 .148-.521.598-.821.45-.298 1.023-.683 1.281-1.146.257-.461.533-.674.714-.76m-.992 10.052l1.279 1.842.97-1.775-.344-.633c-.253.469-.524.973-.679 1.246l-.863-1.246-.363.566" fill="#0055A6"></path><path d="M88.166 47.338c-1.246-1.795-2.787-4.02-2.943-4.244l.484-.357-1.527-.6.029 1.707.516-.381 3.081 4.441.36-.566M77.643 37.25c.378-.422 1.017-.059 1.66.553.646.608 1.053 1.232.676 1.655-.348.39-1.016.058-1.661-.552-.645-.609-1.052-1.234-.675-1.656" fill="#0055A6"></path><path d="M78.684 44.751a.985.985 0 0 1-.061-.054c-.342-.309-.537-.783-.537-1.302 0-.998.789-1.81 1.759-1.81.97 0 1.758.812 1.758 1.81 0 .136-.025.355-.025.355.081-.155.369-.845.429-.97-.263-.975-1.133-1.691-2.161-1.691-.885 0-1.651.53-2.016 1.298.139-.912.579-1.733.894-2.037.373-.363 1.01-.479 1.01-.479-.416.069-.967-.195-1.583-.776-.585-.553-.886-1.034-.903-1.438.037.57.02.889-.137 1.352-.214.631-.795 1.793-.588 3.105.115.721.623 1.793 1.473 2.67.18.197.25.488.27.641 0 0 1.255 0 1.552.026 0 0 .298-.026.293-.219-.005-.19-.171-.239-.319-.239s-.774.014-1.108-.242m6.929.438c-.805.301-1.609.458-2.372.578a7.008 7.008 0 0 1-1.447.082.445.445 0 0 1-.038.262s.094.111.094.236c.473.02.965-.01 1.467-.089.832-.132 1.71-.306 2.592-.648l-.296-.421m1.323-.063c1.068-.602 2.113-1.527 3.053-3.007l.17-.291c-.257.117-.588.037-.588.037-.015.024-.057.09-.078.127-.878 1.333-1.849 2.174-2.843 2.723l.286.411m-7.051.472c-.146-.024-.615-.012-.898.033-.307.05-.658.115-.694.289-.036.166.077.343.231.594.098.155.325.066.453.018s.85-.447.967-.578c.117-.133.164-.317-.059-.356m.738.491a.533.533 0 0 0-.463-.049c-.195.076-.908.509-.955.711-.048.201.049.305.16.35.109.045.244.087.342.097a.54.54 0 0 0 .443-.206c.092-.115.424-.53.473-.624.047-.093.074-.229 0-.279m.086.455a9.629 9.629 0 0 0-.425.537c-.034.06.017.151.108.142.089-.009.578-.061.861-.26.281-.197.47-.578.275-.717-.192-.141-.491-.078-.819.298m.158-1.099c-.093-.023-.463-.121-.544.006-.101.156-.028.325.259.468.287.142.83.255.938.103.107-.155-.041-.415-.653-.577m12.229-10.297c-.093.302-.367.858-.402 1.029-.066.32.022.707.59 1.119 0 0 .367-.264.514-.611.136-.326.055-.555-.086-.723-.143-.169-.474-.56-.616-.814m-1.194 1.195c0 .162.118 1.075.371 1.528.354.637.874 1.111 1.33 1.111.424 0 .512-.259.722-.365 0 0-.106-.553-.583-.698-.581-.178-1.476-.898-1.84-1.576m1.524 1.164c.098-.077.182-.131.301-.271 0 0 .45.172.819.428.37.256.733.691.93.92 0 0-.554.148-.907-.017 0 0-.129-.545-.523-.788-.087-.053-.364-.136-.62-.272m.462-.468c.086-.137.262-.391.224-.787 0 0 .779.506 1.014.701.235.195.721.712.83.882 0 0-.591-.132-1.043-.287-.499-.171-.841-.4-1.025-.509m1.32.869c.419.152 1.364.311 1.76.431.396.12.683.331 1.062.756 0 0-.581.165-.891.268 0 0-.494-.347-1.034-.56-.353-.139-.523-.52-.897-.895m.878 2.865c-.09-.102-.203-.221-.116-.462.062-.177.405-.37.612-.474.339-.165 1.279-.424 1.584-.517 0 0 .152.185.233.379.036.075-.011.152-.144.177-.262.045-.893-.075-1.045.027-.165.11-.107.26-.107.407 0 0-.287-.18-.469-.14-.251.059-.404.179-.548.603m.838-1.343c-.068.023-.434.139-.793.371 0 0-.157-.062-.234-.213-.076-.144-.398-.632-.691-.697 0 0 .248-.025.393-.071 0 0 .307.081.523.171.216.09.486.228.802.439m-2.424-.617c.057.027.15.073.369.083 0 0 .828.59.926 1.177.084.504-.174.744-.299.808-.127.064-.702.309-1.078-.486 0 0 .639.216.814-.102.174-.316-.107-.777-.282-.91-.228-.175-.639-.294-.891-.248.001 0 .203-.197.441-.322" fill="#0055A6"></path><path d="M99.913 45.561c-.101-.432-.212-.888-.405-1.307-.371-.812-1.288-2.979-3.197-3.361-.182-.035.205-.492.375-.47.174.022.514.248.664.351 0 0 0-.462.004-.544.006-.083.076-.114.15-.11.073.001.537-.004.682.17.436.518 1.17 1.912 1.586 2.951.418 1.037.703 1.354 1.141 1.194.44-.157.703-.676 1.471-.518.264.053.557.237.789.508-.063.126-.145.28-.503.28-.359 0-1.042.155-1.423.43-.383.272-.782.364-1.334.426m-7.628-6.715c-.039.334-.199.649-.373.975 0 0 .582 2.761 2.685 2.975 0 0-.042-.572-.664-1.009-.624-.436-1.555-1.111-1.489-2.138 0 0 .166.035.467.42.299.385.954 1.496 1.969 1.504 0 0-.15-.521-.598-.821-.449-.298-1.023-.683-1.281-1.146-.259-.461-.532-.674-.716-.76m-1.394 2.675c.121.368.918 1.522 1.267 1.852.349.33 1.197 1.201 1.649 1.639 0 0-1.291-.33-2.016-1.008 0 0-.519.311-.895.311h-.021c-.376 0-.894-.311-.894-.311-.726.678-2.017 1.008-2.017 1.008.453-.438 1.301-1.31 1.649-1.639.35-.329 1.146-1.483 1.269-1.852h.009" fill="#0055A6"></path><path d="M90.895 44.585c.285 0 .557-.117.707-.185-.15.33-.439.843-.713 1.057h-.006c-.273-.214-.561-.727-.713-1.057.152.067.42.185.706.185h.019" fill="#0055A6"></path><path d="M91.998 50.74l5.051-7.277.516.381.029-1.707-1.527.6.482.357c-.246.358-4.022 5.801-4.498 6.484l-2.287-4.261-.281.442-2.036 3.162-.509-.35-.008 1.684 1.544-.631-.517-.353c.279-.437 1.385-2.151 1.754-2.725l2.287 4.194" fill="#0055A6"></path><path d="M92.922 47.881c-.342-.527-.685-1.06-.859-1.333-.127.244-.389.724-.677 1.253l-.36-.664.982-1.819.283.442 1.012 1.572-.381.549m1.039.474l.365.566.509-.35.009 1.684-1.545-.631.516-.353-.234-.367.38-.549m10.17-11.105c-.379-.422-1.017-.059-1.662.553-.646.608-1.051 1.232-.676 1.655.35.39 1.018.058 1.663-.552.645-.609 1.051-1.234.675-1.656" fill="#0055A6"></path><path d="M103.09 44.751a.739.739 0 0 0 .059-.054c.344-.309.539-.783.539-1.302 0-.998-.789-1.81-1.76-1.81-.969 0-1.757.812-1.757 1.81 0 .136.025.355.025.355-.079-.155-.369-.845-.428-.97.262-.975 1.13-1.691 2.159-1.691.887 0 1.653.53 2.017 1.298-.139-.912-.581-1.733-.894-2.037-.373-.363-1.012-.479-1.012-.479.418.069.969-.195 1.584-.776.585-.553.887-1.034.904-1.438-.037.57-.02.889.137 1.352.213.631.794 1.793.587 3.105-.114.721-.622 1.793-1.471 2.67-.183.197-.251.488-.271.641 0 0-1.253 0-1.551.026 0 0-.298-.026-.293-.219.006-.19.171-.239.318-.239.151-.001.774.014 1.108-.242m-8.255.374c-1.067-.603-2.11-1.527-3.052-3.006l-.168-.291c.256.117.588.037.588.037.016.024.056.09.078.127.876 1.331 1.848 2.172 2.841 2.721l-.287.412m1.32.063c.808.303 1.612.46 2.376.58.496.079.982.105 1.447.082a.453.453 0 0 0 .039.262s-.094.111-.094.236c-.475.02-.965-.01-1.467-.089-.832-.132-1.711-.306-2.592-.648l.291-.423m5.734.41c.147-.024.616-.012.897.033.308.05.659.115.696.289.035.166-.076.343-.234.594-.097.155-.324.066-.453.018-.126-.049-.848-.447-.966-.578-.116-.133-.164-.317.06-.356m-.741.491a.539.539 0 0 1 .465-.049c.193.076.907.509.955.711.047.201-.049.305-.16.35a1.401 1.401 0 0 1-.342.097.54.54 0 0 1-.443-.206c-.091-.115-.425-.53-.475-.624-.046-.093-.072-.229 0-.279m-.085.455c.103.118.392.479.426.537.032.06-.017.151-.106.142-.092-.009-.582-.061-.862-.26-.282-.197-.471-.578-.276-.717.192-.141.493-.078.818.298m-.158-1.099c.093-.023.464-.121.545.006.101.156.028.325-.259.468-.287.142-.83.255-.938.103-.106-.155.044-.415.652-.577" fill="#0055A6"></path></g></svg>',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'GMLs5YYbov_yAKtB-tNNNPCW6XTTqlm_',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\security\UserIdentity',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
