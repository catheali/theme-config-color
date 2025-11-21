<?php
declare(strict_types=1);

namespace DevAlicia2\ThemeConfig\Console;

use DevAlicia2\ThemeConfig\Model\ChangeColors;
use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ColorPrimaryCommand extends Command
{
    const COLOR = 'color';
    const STORE = 'store';

    private ChangeColors $changeColors;

    public function __construct(ChangeColors $changeColors)
    {
        parent::__construct();
        $this->changeColors = $changeColors;
    }

    protected function configure()
    {
        $this->setName('color:change')
            ->setDescription('Alterar a cor do botão primário por Store View')
            ->addArgument(self::COLOR, InputArgument::REQUIRED)
            ->addArgument(self::STORE, InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $color = $input->getArgument(self::COLOR);
        $storeId = (int)$input->getArgument(self::STORE);

        try {
            $this->changeColors->changeColorPrimary($color, $storeId);
            $output->writeln("<info>Cor primária atualizada para a loja {$storeId}</info>");
        } catch (\Exception $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");
            return Cli::RETURN_FAILURE;
        }

        return Cli::RETURN_SUCCESS;
    }
}
