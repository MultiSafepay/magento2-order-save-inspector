<p align="center">
  <img src="https://camo.githubusercontent.com/517483ae0eaba9884f397e9af1c4adc7bbc231575ac66cc54292e00400edcd10/68747470733a2f2f7777772e6d756c7469736166657061792e636f6d2f66696c6561646d696e2f74656d706c6174652f696d672f6d756c7469736166657061792d6c6f676f2d69636f6e2e737667" width="400px" position="center">
</p>

# Order Save Inspector by MultiSafepay

## General information

This module is created as an example of how to properly debug issues related with race conditions which occur when multiple processes try to save the order.
This module is not considered as a perfect solution that will always work in every case.
Please use with caution. Always test on a staging environment first, before moving this over to production.
When using in production, please keep in mind that this module will write a lot of log lines when activated.
We therefore recommend to immediately deactivate this as soon as the issue has occurred and has been properly logged.

This module will probably not give an immediate answer to your problem, but will hopefully bring you a step closer to finding the cause of it.

## Installation

This module can be installed via composer:

```shell
composer require multisafepay/magento2-order-save-inspector
```

Alternatively, this can also be installed through downloading [the zip package](https://github.com/MultiSafepay/magento2-internal-order-save-inspector/archive/refs/heads/main.zip) and unpacking the contents to the app/code/MultiSafepay/OrderSaveInspector directory

Next, enable the module:
```bash
bin/magento module:enable MultiSafepay_OrderSaveInspector
```

## Configuration

To activate the feature, go to Stores > Configuration > MultiSafepay > Order Save Inspector > Enabled and Set the value to Yes.

You can also change the maximum depth to configure how deep you want the debugger to log the backtrace.
We recommend to only change this when the default value does not go far enough as logging a lot of lines can impact the performance of your store.

## Support
You can create issues on our repository. If you need any additional help or support, please contact <a href="mailto:integration@multisafepay.com">integration@multisafepay.com</a>

We are also available on our Magento Slack channel [#multisafepay-payments](https://magentocommeng.slack.com/messages/multisafepay-payments/).
Feel free to start a conversation or provide suggestions as to how we can refine our Magento 2 plugin.

## License
[Open Software License (OSL 3.0)](https://github.com/MultiSafepay/Magento2Msp/blob/master/LICENSE.md)

## Contributors
Special thanks to @hostep for providing us with the original source code.
